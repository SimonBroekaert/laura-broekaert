<?php

use App\Models\User;

it('can be created', function () {
    $user = User::factory()->create();

    test()->assertDataBaseHas('users', [
        'id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
        'type' => $user->type,
        'password' => $user->password,
    ]);
});

it('has an attribute to check if the user is an admin', function (User $user, bool $expected) {
    test()->assertEquals($expected, $user->is_admin);
})->with([
    [fn () => User::factory()->admin()->create(), true],
    [fn () => User::factory()->developer()->create(), false],
]);

it('has an attribute to check if the user is a developer', function (User $user, bool $expected) {
    test()->assertEquals($expected, $user?->is_developer);
})->with([
    [fn () => User::factory()->admin()->create(), false],
    [fn () => User::factory()->developer()->create(), true],
]);

it('has a scope to only fetch admins', function () {
    User::factory()->admin()->create();
    User::factory()->developer()->create();

    test()->assertCount(1, User::admins()->get());
});

it('has a scope to only fetch developers', function () {
    User::factory()->admin()->create();
    User::factory()->developer()->create();

    test()->assertCount(1, User::developers()->get());
});
