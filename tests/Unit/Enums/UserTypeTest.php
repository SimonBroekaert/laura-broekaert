<?php

use App\Enums\UserType;

test('All cases have a label', function () {
    $cases = UserType::cases();

    foreach ($cases as $case) {
        test()->assertNotEmpty($case->label());
    }
});

it('uses the hasLabels trait to get the labels', function () {
    $labels = UserType::labels();

    foreach (UserType::cases() as $case) {
        test()->assertArrayHasKey($case->value, $labels);
        test()->assertEquals($case->label(), $labels[$case->value]);
    }
});
