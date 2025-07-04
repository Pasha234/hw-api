<?php

namespace App\DTO\ProcessNewPayment;

class Response
{
    public function __construct(
        public string $transaction_id,
        public string $status,
        public string $date
    ) {}
}