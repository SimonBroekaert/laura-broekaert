<?php

namespace App\Nova\Flexible\Layouts\Traits;

use Illuminate\Support\Str;

trait Fakable
{
    abstract public static function fakeDefinition(): array;

    public static function fake(int $count = 1, $asJsonString = true): self|array|string
    {
        $data = collect(range(1, $count))
            ->map(function () {
                $attributes = self::fakeDefinition();

                return [
                    'key' => Str::random(16),
                    'layout' => (new self())->name,
                    'attributes' => $attributes,
                ];
            })
            ->toArray();

        if ($count === 1) {
            $data = $data[0];
        }

        return $asJsonString ? json_encode($data) : $data;
    }
}
