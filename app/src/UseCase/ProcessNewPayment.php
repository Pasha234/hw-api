<?php

namespace App\UseCase;

use App\Entity\Payment;
use App\Entity\PaymentStatus;
use App\Event\PaymentProcessedEvent;
use App\DTO\ProcessNewPayment\Request;
use App\DTO\ProcessNewPayment\Response;
use App\Payment\TransactionIdGenerator;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class ProcessNewPayment
{
    public function __construct(
        private TransactionIdGenerator $transactionIdGenerator,
        private EventDispatcherInterface $eventDispatcher,
    ) {}

    public function execute(Request $request): Response
    {
        sleep(10);
        $payment = new Payment(
            $request->fio,
            $request->total,
            $request->date,
            $request->email,
        );

        $payment->setTransactionId(
            $this->transactionIdGenerator->generate()
        );
        $payment->setStatus(
            PaymentStatus::paid
        );

        $this->eventDispatcher->dispatch(
            new PaymentProcessedEvent($payment)
        );

        return new Response(
            $payment->getTransactionId(),
            $payment->getStatus(),
            $payment->getDate(),
        );
    }
}