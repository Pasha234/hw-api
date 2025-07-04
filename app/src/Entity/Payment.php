<?php

namespace App\Entity;

class Payment
{
    private string $fio;
    private float $total;
    private string $date;
    private string $email;
    private ?string $transaction_id;
    private ?string $status;

    public function __construct($fio, $total, $date, $email, $transaction_id = null, $status = null)
    {
        $this->fio = $fio;
        $this->total = $total;
        $this->date = $date;
        $this->email = $email;
        $this->transaction_id = $transaction_id;
        $this->status = $status ?? PaymentStatus::pending->value;
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

    public function getTransactionId(): string
    {
        return $this->transaction_id;
    }

    public function setTransactionId(string $transaction_id)
    {
        $this->transaction_id = $transaction_id;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(PaymentStatus $status)
    {
        $this->status = $status->value;
    }
}