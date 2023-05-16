<?php

namespace App\Enums;

enum OrderStatusEnum: int
{
    case Created = 0;
    case AwaitingForApprove = 1;
    case Approved = 2;
    case Processing = 3;
    case Fulfilled = 4;
    case Canceled = 5;
}
