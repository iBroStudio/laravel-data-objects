<?php

declare(strict_types=1);

use IBroStudio\DataObjects\Rules\UuidRule;
use Illuminate\Validation\ValidationException;

it('passes validation with valid UuidRule values', function () {
    Validator::make(
        [
            'attribute1' => '550e8400-e29b-41d4-a716-446655440000',
            'attribute2' => '6ba7b810-9dad-11d1-80b4-00c04fd430c8',
            'attribute3' => '6ba7b811-9dad-11d1-80b4-00c04fd430c8',
            'attribute4' => '6ba7b812-9dad-11d1-80b4-00c04fd430c8',
            'attribute5' => '6ba7b814-9dad-11d1-80b4-00c04fd430c8',

        ],
        [
            'attribute1' => new UuidRule(),
            'attribute2' => new UuidRule(),
            'attribute3' => new UuidRule(),
            'attribute4' => new UuidRule(),
            'attribute5' => new UuidRule(),
        ]
    )
        ->validate();

    expect(true)->toBeTrue();
});

it('passes validation with null value', function () {
    Validator::make(
        ['attribute' => null],
        ['attribute' => new UuidRule()]
    )
        ->validate();

    expect(true)->toBeTrue();
});

it('fails validation with invalid value', function () {
    Validator::make(
        ['attribute' => 'invalid-value'],
        ['attribute' => new UuidRule()]
    )
        ->validate();
})->throws(ValidationException::class);
