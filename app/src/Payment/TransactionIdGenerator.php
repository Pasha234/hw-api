<?php

namespace App\Payment;

class TransactionIdGenerator
{
    public function generate(): string
    {
        return uniqid("", true);
    }
}