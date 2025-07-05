<?php

namespace App\DTO\ProcessNewPayment;

class Request
{
    public function __construct(
        public int $id
    ) {}
}