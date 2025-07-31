<?php

declare(strict_types=1);

use IBroStudio\DataObjects\Rules\SemanticVersionRule;
use Illuminate\Validation\ValidationException;

it('passes validation with valid SemanticVersionRule values', function () {
    Validator::make(
        [
            'attribute1' => '1.0.0',
            'attribute2' => '2.1.0',
            'attribute3' => 'v.3.2.1',
            'attribute4' => '4.0.0-alpha',
            'attribute5' => '5.0.0-beta.1',

        ],
        [
            'attribute1' => new SemanticVersionRule(),
            'attribute2' => new SemanticVersionRule(),
            'attribute3' => new SemanticVersionRule(),
            'attribute4' => new SemanticVersionRule(),
            'attribute5' => new SemanticVersionRule(),
        ]
    )
        ->validate();

    expect(true)->toBeTrue();
});

it('passes validation with null value', function () {
    Validator::make(
        ['attribute' => null],
        ['attribute' => new SemanticVersionRule()]
    )
        ->validate();

    expect(true)->toBeTrue();
});

it('fails validation with invalid value', function () {
    Validator::make(
        ['attribute' => 'invalid-value'],
        ['attribute' => new SemanticVersionRule()]
    )
        ->validate();
})->throws(ValidationException::class);
