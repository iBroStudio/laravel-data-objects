<?php

declare(strict_types=1);

use IBroStudio\DataObjects\Rules\EmailRule;
use Illuminate\Validation\ValidationException;

it('passes validation with valid EmailRule values', function () {
    Validator::make(
        [
            'attribute1' => 'user@example.com',
            'attribute2' => 'john.doe@example.org',
            'attribute3' => 'info@example.net',
            'attribute4' => 'support@example.io',
            'attribute5' => 'contact@example.co.uk',

        ],
        [
            'attribute1' => new EmailRule(),
            'attribute2' => new EmailRule(),
            'attribute3' => new EmailRule(),
            'attribute4' => new EmailRule(),
            'attribute5' => new EmailRule(),
        ]
    )
        ->validate();

    expect(true)->toBeTrue();
});

it('passes validation with null value', function () {
    Validator::make(
        ['attribute' => null],
        ['attribute' => new EmailRule()]
    )
        ->validate();

    expect(true)->toBeTrue();
});

it('fails validation with invalid value', function () {
    Validator::make(
        ['attribute' => 'invalid-value'],
        ['attribute' => new EmailRule()]
    )
        ->validate();
})->throws(ValidationException::class);
