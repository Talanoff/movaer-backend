<?php

namespace App\Enums;

enum WishCategoryEnum: string
{
    case Common = 'common';
    case Additional = 'additional';

    public static function names(): array
    {
        return [
            self::Common->value => __('forms.wishes.' . self::Common->value),
            self::Additional->value => __('forms.wishes.' . self::Additional->value),
        ];
    }
}
