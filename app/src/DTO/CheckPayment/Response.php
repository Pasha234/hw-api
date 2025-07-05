<?php

namespace App\DTO\CheckPayment;

class Response
{
    public function __construct(
        public ?string $transaction_id,
        public ?string $status,
        public ?string $date
    ) {}
}