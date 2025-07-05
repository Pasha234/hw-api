<?php

namespace App\UseCase;

use App\Entity\Payment;
use App\Entity\PaymentStatus;
use Doctrine\ORM\NoResultException;
use App\Event\PaymentProcessedEvent;
use App\Repository\PaymentRepository;
use App\DTO\ProcessNewPayment\Request;
use App\DTO\ProcessNewPayment\Response;
use App\Payment\TransactionIdGenerator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class ProcessNewPayment
{
    public function __construct(
        private TransactionIdGenerator $transactionIdGenerator,
        private EventDispatcherInterface $eventDispatcher,
        private PaymentRepository $paymentRepository,
        private EntityManagerInterface $entityManager,
    ) {}

    public function execute(Request $request): Response
    {
        sleep(10);
        /** @var Payment */
        $payment = $this->paymentRepository->find($request->id);

        if (!$payment) {
            throw new NoResultException();
        }

        $payment->setTransactionId(
            $this->transactionIdGenerator->generate()
        );
        $payment->setStatus(
            PaymentStatus::paid
        );

        $this->entityManager->flush();

        $this->eventDispatcher->dispatch(
            new PaymentProcessedEvent($payment)
        );

        return new Response(
            $payment->getTransactionId(),
            $payment->getStatus()->value,
            $payment->getDate()->format('Y-m-d'),
        );
    }
}