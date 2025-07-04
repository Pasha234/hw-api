<?php

namespace App\Entity;

enum PaymentStatus: string
{
    case pending = "Pending";
    case paid = "Paid";
    case failed = "Failed";
    case canceled = "Canceled";
}