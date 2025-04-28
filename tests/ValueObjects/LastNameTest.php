<?php

use IBroStudio\DataObjects\ValueObjects\LastName;
use Illuminate\Support\Str;

it('can instantiate LastName object value', function () {
    expect(LastName::from(fake()->lastName))
        ->toBeInstanceOf(LastName::class);
});

it('formats name LastName object value', function () {
    $name = fake()->lastName;

    expect(
        LastName::from($name)->value
    )->toEqual(Str::upper($name));
});
