<?php

namespace App\Events;

use App\Models\Vendor;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VendorCreatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(private readonly Vendor $vendor)
    {
        //
    }

    public function getVendor(): Vendor
    {
        return $this->vendor;
    }
}
