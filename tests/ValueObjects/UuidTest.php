<?php

declare(strict_types=1);

use IBroStudio\DataObjects\ValueObjects\Uuid;
use Illuminate\Validation\ValidationException;

it('can instantiate Uuid object value', function () {
    expect(Uuid::from(fake()->uuid))
        ->toBeInstanceOf(Uuid::class);
});

it('can validate Uuid object value', function () {
    Uuid::from('invalid-uuid');
})->throws(ValidationException::class);
