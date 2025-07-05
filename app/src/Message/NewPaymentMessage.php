<?php

namespace App\Message;

class NewPaymentMessage
{
    private int $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }
}