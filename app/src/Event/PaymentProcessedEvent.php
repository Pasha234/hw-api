<?php

namespace App\Event;

use App\Entity\Payment;
use Symfony\Contracts\EventDispatcher\Event;

class PaymentProcessedEvent extends Event
{
    public function __construct(
        private Payment $payment
    ) {
    }

    public function getPayment(): Payment
    {
        return $this->payment;
    }
}