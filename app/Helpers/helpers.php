<?php

use Carbon\Carbon;

if (! function_exists('formatDateTime')) {
    function formatDateTime(Carbon $datetime, $dateFormat = 'dddd, LL', $timeFormat = 'HH\umm', $glue = 'om'): string
    {
        $data = formatDate($datetime, $dateFormat);
        $time = $datetime->isoFormat($timeFormat);

        return "{$data} {$glue} {$time}";
    }
}

if (! function_exists('formatDate')) {
    function formatDate(Carbon $datetime, $dateFormat = 'dddd, LL'): string
    {
        return $datetime->isoFormat($dateFormat);
    }
}

if (! function_exists('generateCode')) {
    function generateCode(): string
    {
        $characters = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
        $charactersLength = strlen($characters);
        $code = '';

        for ($i = 0; $i < 6; $i++) {
            $code .= $characters[rand(0, $charactersLength - 1)];
        }

        return $code;
    }
}

if (! function_exists('isOdd')) {
    /**
     * Check if a number is odd.
     *
     * @param int $number
     *
     * @return bool
     */
    function isOdd(int $number): bool
    {
        return $number % 2 !== 0;
    }
}

if (! function_exists('isEven')) {
    /**
     * Check if a number is even.
     *
     * @param int $number
     *
     * @return bool
     */
    function isEven(int $number): bool
    {
        return $number % 2 === 0;
    }
}

if (! function_exists('novaBadgeColor')) {
    function novaBadgeColor(string $color): string
    {
        return "bg-{$color}-100 text-{$color}-600 dark:bg-{$color}-500 dark:text-{$color}-900";
    }
}

if (! function_exists('setting')) {
    function setting(string $key, $default = null)
    {
        return nova_get_setting($key, $default);
    }
}

if (! function_exists('settings')) {
    function settings(array $keys, $defaults = [])
    {
        return nova_get_settings($keys, $defaults);
    }
}
