<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class OrderDetailsData extends Data
{
    #[MapOutputName('wishes')]
    public array $data;

    public array|Optional $contact;

    public function __construct(
        ?array  $wishes,
        ?array  $additionalWishes,
        ?string $additionalWishesNotes
    )
    {
        $this->data['common']['items'] = $wishes ?? [];
        $this->data['additional']['items'] = $additionalWishes ?? [];
        $this->data['additional']['notes'] = $additionalWishesNotes;
    }
}
