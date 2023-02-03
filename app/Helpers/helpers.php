<?php

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
