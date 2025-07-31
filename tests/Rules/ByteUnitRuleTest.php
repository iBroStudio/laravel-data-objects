<?php

declare(strict_types=1);

use IBroStudio\DataObjects\Rules\ByteUnitRule;
use Illuminate\Validation\ValidationException;

it('passes validation with valid byte unit values', function () {
    Validator::make(
        [
            'attribute1' => '10B',
            'attribute2' => '1kB',
            'attribute3' => '2MB',
            'attribute4' => '3GB',
            'attribute5' => '4TB',
            'attribute6' => '5PB',
            'attribute7' => '6EB',
            'attribute8' => '1024B',
            'attribute9' => '1.5MB',
            'attribute10' => '0.5GB',
        ],
        [
            'attribute1' => new ByteUnitRule(),
            'attribute2' => new ByteUnitRule(),
            'attribute3' => new ByteUnitRule(),
            'attribute4' => new ByteUnitRule(),
            'attribute5' => new ByteUnitRule(),
            'attribute6' => new ByteUnitRule(),
            'attribute7' => new ByteUnitRule(),
            'attribute8' => new ByteUnitRule(),
            'attribute9' => new ByteUnitRule(),
            'attribute10' => new ByteUnitRule(),
        ]
    )
        ->validate();

    expect(true)->toBeTrue();
});

it('passes validation with null value', function () {
    Validator::make(
        ['attribute' => null],
        ['attribute' => new ByteUnitRule()]
    )
        ->validate();

    expect(true)->toBeTrue();
});

it('fails validation with invalid value', function () {
    Validator::make(
        ['attribute' => 'not-a-byte-unit'],
        ['attribute' => new ByteUnitRule()]
    )
        ->validate();
})->throws(ValidationException::class);
