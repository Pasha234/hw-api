<?php

namespace App\EventListener;

use App\Event\PaymentProcessedEvent;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

#[AsEventListener(event: PaymentProcessedEvent::class, method: 'onPaymentProcessed')]
class PaymentProcessedListener
{
    public function __construct(
        private MailerInterface $mailer
    ) {
    }

    public function onPaymentProcessed(PaymentProcessedEvent $event): void
    {
        $payment = $event->getPayment();

        $email = (new TemplatedEmail())
            ->from('welcome@example.com')
            ->to($payment->getEmail())
            ->subject('Your payment is processed!')
            ->htmlTemplate('emails/payment_processed.html.twig')
            ->context([
                'transaction_id' => $payment->getTransactionId()
            ]);

        $this->mailer->send($email);
    }
}