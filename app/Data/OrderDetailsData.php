<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;

class OrderDetailsData extends Data
{
    #[MapOutputName('wishes')]
    public array $data;

    public array $contact;

    public function __construct(
        ?array $wishes,
        ?array $additionalWishes,
        ?string $additionalWishesNotes
    ) {
        $this->data['common']['items'] = $wishes ?? [];
        $this->data['additional']['items'] = $additionalWishes ?? [];
        $this->data['additional']['notes'] = $additionalWishesNotes;
    }
}
