<?php

declare(strict_types=1);

use IBroStudio\DataObjects\Rules\PhoneRule;
use Illuminate\Validation\ValidationException;

it('passes validation with valid PhoneRule values', function () {
    Validator::make(
        [
            'attribute1' => '0123456789',
            'phoneCountryIsoCode2' => 'FR',
            'attribute2' => '+44 1234 567890',
            'attribute3' => '+33 1 23 45 67 89',
            'attribute4' => '+49 123 4567890',
            'attribute5' => '+61 2 3456 7890',
        ],
        [
            'attribute1' => new PhoneRule(),
            'phoneCountryIsoCode2' => 'string',
            'attribute2' => new PhoneRule(),
            'attribute3' => new PhoneRule(),
            'attribute4' => new PhoneRule(),
            'attribute5' => new PhoneRule(),
        ]
    )
        ->validate();

    expect(true)->toBeTrue();
});

it('passes validation with null value', function () {
    Validator::make(
        ['attribute' => null],
        ['attribute' => new PhoneRule()]
    )
        ->validate();

    expect(true)->toBeTrue();
});

it('fails validation with invalid value', function () {
    Validator::make(
        ['attribute' => 'invalid-value'],
        ['attribute' => new PhoneRule()]
    )
        ->validate();
})->throws(ValidationException::class);
