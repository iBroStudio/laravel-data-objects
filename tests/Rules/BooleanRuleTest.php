<?php

declare(strict_types=1);

use IBroStudio\DataObjects\Rules\BooleanRule;
use Illuminate\Validation\ValidationException;

it('passes validation with valid boolean values', function () {
    Validator::make(
        [
            'attribute1' => true,
            'attribute2' => false,
            'attribute3' => 1,
            'attribute4' => 0,
            'attribute5' => '1',
            'attribute6' => '0',
            'attribute7' => 'true',
            'attribute8' => 'false',
            'attribute9' => 'no',
            'attribute10' => 'on',
            'attribute11' => 'yes',
            'attribute12' => 'off',
        ],
        [
            'attribute1' => new BooleanRule(),
            'attribute2' => new BooleanRule(),
            'attribute3' => new BooleanRule(),
            'attribute4' => new BooleanRule(),
            'attribute5' => new BooleanRule(),
            'attribute6' => new BooleanRule(),
            'attribute7' => new BooleanRule(),
            'attribute8' => new BooleanRule(),
            'attribute9' => new BooleanRule(),
            'attribute10' => new BooleanRule(),
            'attribute11' => new BooleanRule(),
            'attribute12' => new BooleanRule(),
        ]
    )
        ->validate();

    expect(true)->toBeTrue();
});

it('passes validation with null value', function () {
    Validator::make(
        ['attribute' => null],
        ['attribute' => new BooleanRule()]
    )
        ->validate();

    expect(true)->toBeTrue();
});

it('fails validation with invalid boolean value', function () {
    Validator::make(
        ['attribute' => 'not-a-boolean'],
        ['attribute' => new BooleanRule()]
    )
        ->validate();
})->throws(ValidationException::class);
