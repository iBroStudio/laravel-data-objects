<?php

use IBroStudio\DataObjects\ValueObjects\HashedPassword;
use Illuminate\Support\Facades\Hash;

it('can instantiate HashedPassword object value', function () {
    expect(HashedPassword::from(fake()->password))
        ->toBeInstanceOf(HashedPassword::class);
});

it('can hash HashedPassword object value', function () {
    $password = fake()->password;

    expect(
        Hash::check($password, HashedPassword::from($password)->value)
    )
        ->toBeTrue();
});
