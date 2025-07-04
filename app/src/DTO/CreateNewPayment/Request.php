<?php

namespace App\DTO\CreateNewPayment;

use Symfony\Component\Validator\Constraints as Assert;

class Request
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Length(min: 10, max: 100)]
        public string $fio,
        #[Assert\NotBlank]
        #[Assert\Positive]
        public float $total,
        #[Assert\NotBlank]
        #[Assert\Date]
        public string $date,
        #[Assert\NotBlank]
        #[Assert\Email]
        public string $email,
    ) {}
}