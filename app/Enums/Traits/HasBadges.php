<?php

namespace App\Enums\Traits;

trait HasBadges
{
    abstract public function badge(): string;

    public static function badges(): array
    {
        return collect(static::cases())
            ->mapWithKeys(fn ($case) => [$case->value => $case->badge()])
            ->toArray();
    }
}
