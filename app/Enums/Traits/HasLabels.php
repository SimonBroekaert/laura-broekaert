<?php

namespace App\Enums\Traits;

trait HasLabels
{
    public static function labels(): array
    {
        return collect(static::cases())
            ->mapWithKeys(fn ($case) => [$case->value => $case->label()])
            ->toArray();
    }
}
