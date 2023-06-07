<?php

namespace App\Data;

enum RecurringShippingTypeEnum: int
{
    case EveryDay = 0;
    case EveryWorkingDay = 1;
    case EveryHoliday = 2;
    case EveryWeek = 3;
    case EveryTwoWeeks = 4;
    case EveryMonth = 5;
    case CustomRange = 6;

    public static function toResource(): array
    {
        return array_map(static fn ($it) => [
            'key' => $it->value,
            'value' => trans('forms.recurring_shipping.'.$it->value),
        ], self::cases());
    }
}
