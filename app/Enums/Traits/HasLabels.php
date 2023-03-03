<?php

namespace App\Enums\Traits;

trait HasLabels
{
    abstract public function label(): string;

    public static function labels(): array
    {
        return collect(static::cases())
            ->mapWithKeys(fn ($case) => [$case->value => $case->label()])
            ->toArray();
    }
}
