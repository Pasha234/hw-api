<?php

namespace App\UseCase;

use App\DTO\CreateNewPayment\Request;
use App\DTO\CreateNewPayment\Response;
use App\Entity\Payment;
use App\Message\NewPaymentMessage;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class CreateNewPayment
{
    public function __construct(
        private MessageBusInterface $bus,
        private EntityManagerInterface $entityManager
    ) {}

    public function execute(Request $request): Response
    {
        $payment = new Payment();
        $payment->setFio($request->fio);
        $payment->setTotal($request->total);
        $payment->setDate(new DateTime($request->date));
        $payment->setEmail($request->email);

        $this->entityManager->persist($payment);
        $this->entityManager->flush();

        $this->bus->dispatch(new NewPaymentMessage(
            $payment->getId(),
        ));

        return new Response(
            $payment->getId()
        );
    }
}