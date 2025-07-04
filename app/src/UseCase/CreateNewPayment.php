<?php

namespace App\UseCase;

use App\DTO\CreateNewPayment\Request;
use App\Message\NewPaymentMessage;
use Symfony\Component\Messenger\MessageBusInterface;

class CreateNewPayment
{
    public function __construct(
        private MessageBusInterface $bus
    ) {}

    public function execute(Request $request): void
    {
        $this->bus->dispatch(new NewPaymentMessage(
            $request->fio,
            $request->total,
            $request->date,
            $request->email,
        ));
    }
}