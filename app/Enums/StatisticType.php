<?php

namespace App\Enums;

use App\Enums\Traits\HasLabels;
use App\Enums\Traits\HasValues;

enum StatisticType: string
{
    use HasLabels;
    use HasValues;

    case TYPE_WEIGHT = 'weight';
    case TYPE_HEIGHT = 'height';

    public function label(): string
    {
        return match ($this) {
            self::TYPE_WEIGHT => 'Weight',
            self::TYPE_HEIGHT => 'Height',
        };
    }
}
