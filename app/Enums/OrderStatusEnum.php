<?php

namespace App\Enums;

enum OrderStatusEnum
{
    case Created;
    case AwaitingForApprove;
    case Approved;
    case Processing;
    case Processed;
    case Fulfilled;
    case Canceled;
}
