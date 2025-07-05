<?php

namespace App\MessageHandler;

use App\DTO\ProcessNewPayment\Request;
use App\Message\NewPaymentMessage;
use App\UseCase\ProcessNewPayment;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class NewPaymentMessageHandler
{
    public function __construct(
        private ProcessNewPayment $processNewPayment,
    ) {}

    public function __invoke(NewPaymentMessage $message)
    {
        $this->processNewPayment->execute(new Request(
            $message->getId(),
        ));
    }
}