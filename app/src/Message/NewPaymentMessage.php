<?php

namespace App\Message;

class NewPaymentMessage
{
    private string $fio;
    private float $total;
    private string $date;
    private string $email;

    public function __construct($fio, $total, $date, $email)
    {
        $this->fio = $fio;
        $this->total = $total;
        $this->date = $date;
        $this->email = $email;
    }

    public function getFio(): string
    {
        return $this->fio;
    }

    public function getTotal(): float
    {
        return $this->total;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}