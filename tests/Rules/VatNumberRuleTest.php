<?php

declare(strict_types=1);

use IBroStudio\DataObjects\Rules\VatNumberRule;
use Illuminate\Validation\ValidationException;

it('passes validation with valid VatNumberRule values', function () {
    Validator::make(
        [
            'attribute1' => 'GB123456789',
            'attribute2' => 'DE123456789',
            'attribute3' => 'FR12345678901',
            'attribute4' => 'IT12345678901',
            'attribute5' => 'ES12345678Z',

        ],
        [
            'attribute1' => new VatNumberRule(),
            'attribute2' => new VatNumberRule(),
            'attribute3' => new VatNumberRule(),
            'attribute4' => new VatNumberRule(),
            'attribute5' => new VatNumberRule(),
        ]
    )
        ->validate();

    expect(true)->toBeTrue();
});

it('passes validation with null value', function () {
    Validator::make(
        ['attribute' => null],
        ['attribute' => new VatNumberRule()]
    )
        ->validate();

    expect(true)->toBeTrue();
});

it('fails validation with invalid value', function () {
    Validator::make(
        ['attribute' => 'invalid-value'],
        ['attribute' => new VatNumberRule()]
    )
        ->validate();
})->throws(ValidationException::class);
