<?php

namespace App\Enums;

enum ChatMessageOfferStatusEnum: int
{
    case Pending = 0;
    case Approved = 1;
    case Rejected = 2;
}
