<?php

namespace App\DTO\ProcessNewPayment;

class Request
{
    public function __construct(
        public string $fio,
        public float $total,
        public string $date,
        public string $email,
    ) {}
}