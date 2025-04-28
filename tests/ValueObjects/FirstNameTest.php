<?php

declare(strict_types=1);

use IBroStudio\DataObjects\ValueObjects\FirstName;
use Illuminate\Support\Str;

it('can instantiate FirstName object value', function () {
    expect(FirstName::from(fake()->firstName))
        ->toBeInstanceOf(FirstName::class);
});

it('can format FirstName object value', function () {
    $name = fake()->firstName;

    expect(
        FirstName::from($name)->value
    )->toEqual(Str::ucfirst($name));
});

it('can format composed FirstName object value', function () {
    expect(
        FirstName::from('jean-paul')->value
    )->toEqual('Jean-Paul');
});

it('formats bad typed FirstName object value', function () {
    expect(
        FirstName::from('yANN')->value
    )->toEqual(Str::ucfirst('Yann'));
});
