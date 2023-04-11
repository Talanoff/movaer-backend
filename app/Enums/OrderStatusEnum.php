<?php

namespace App\Enums;

enum OrderStatusEnum: int
{
    case Created = 0;
    case AwaitingForApprove = 1;
    case Approved = 2;
    case Processing = 3;
    case Processed = 4;
    case Fulfilled = 5;
    case Canceled = 6;
}
