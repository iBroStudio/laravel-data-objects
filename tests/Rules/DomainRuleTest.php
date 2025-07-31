<?php

declare(strict_types=1);

use IBroStudio\DataObjects\Rules\DomainRule;
use Illuminate\Validation\ValidationException;

it('passes validation with valid DomainRule values', function () {
    Validator::make(
        [
            'attribute1' => 'example.com',
            'attribute2' => 'example.org',
            'attribute3' => 'example.net',
            'attribute4' => 'example.io',
            'attribute5' => 'example.co.uk',

        ],
        [
            'attribute1' => new DomainRule(),
            'attribute2' => new DomainRule(),
            'attribute3' => new DomainRule(),
            'attribute4' => new DomainRule(),
            'attribute5' => new DomainRule(),
        ]
    )
        ->validate();

    expect(true)->toBeTrue();
});

it('passes validation with null value', function () {
    Validator::make(
        ['attribute' => null],
        ['attribute' => new DomainRule()]
    )
        ->validate();

    expect(true)->toBeTrue();
});

it('fails validation with invalid value', function () {
    Validator::make(
        ['attribute' => 'invalid-value'],
        ['attribute' => new DomainRule()]
    )
        ->validate();
})->throws(ValidationException::class);
