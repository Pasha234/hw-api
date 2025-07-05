<?php

namespace App\UseCase;

use App\Entity\Payment;
use App\DTO\CheckPayment\Request;
use App\DTO\CheckPayment\Response;
use App\Entity\PaymentStatus;
use App\Repository\PaymentRepository;
use Doctrine\ORM\NoResultException;

class CheckPayment
{
    public function __construct(
        private PaymentRepository $paymentRepository,
    ) {}

    public function execute(Request $request): Response
    {
        /** @var Payment */
        $payment = $this->paymentRepository->find($request->id);

        if (!$payment) {
            throw new NoResultException();
        }

        return new Response(
            $payment->getTransactionId(),
            $payment->getStatus()?->value ?? PaymentStatus::pending->value,
            $payment->getDate()->format('Y-m-d'),
        );
    }
}