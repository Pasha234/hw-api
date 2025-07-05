<?php

namespace App\DTO\CheckPayment;

use OpenApi\Attributes as OA;
use Symfony\Component\Validator\Constraints as Assert;

class Request
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Positive]
        public int $id
    ) {}
}