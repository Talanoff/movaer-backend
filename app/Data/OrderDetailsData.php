<?php

namespace App\Data;

use App\Models\Wish;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\{Data, Optional};

class OrderDetailsData extends Data
{
    #[MapOutputName('wishes')]
    public array $data;

    public array|Optional $contact;

    public function __construct(
        array   $wishes,
        array   $additionalWishes,
        ?string $additionalWishesNotes
    )
    {
        if (count($wishes)) {
            $this->data['common']['names'] = Wish::findMany($wishes)->map->name;
        }

        if (count($additionalWishes)) {
            $this->data['additional']['names'] = Wish::findMany($additionalWishes)->map->name;
        }

        if ($additionalWishesNotes) {
            $this->data['additional']['notes'] = $additionalWishesNotes;
        }
    }
}
