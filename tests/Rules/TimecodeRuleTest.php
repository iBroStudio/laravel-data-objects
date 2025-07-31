<?php

declare(strict_types=1);

use IBroStudio\DataObjects\Rules\TimecodeRule;
use Illuminate\Validation\ValidationException;

it('passes validation with valid TimecodeRule values', function () {
    Validator::make(
        [
            'attribute1' => '00:00:00',
            'attribute2' => '01:23:45',
            'attribute3' => '12:34:56',
            'attribute4' => '23:59:59',
            'attribute5' => '10:00:00',

        ],
        [
            'attribute1' => new TimecodeRule(),
            'attribute2' => new TimecodeRule(),
            'attribute3' => new TimecodeRule(),
            'attribute4' => new TimecodeRule(),
            'attribute5' => new TimecodeRule(),
        ]
    )
        ->validate();

    expect(true)->toBeTrue();
});

it('passes validation with null value', function () {
    Validator::make(
        ['attribute' => null],
        ['attribute' => new TimecodeRule()]
    )
        ->validate();

    expect(true)->toBeTrue();
});

it('fails validation with invalid value', function () {
    Validator::make(
        ['attribute' => 'invalid-value'],
        ['attribute' => new TimecodeRule()]
    )
        ->validate();
})->throws(ValidationException::class);
