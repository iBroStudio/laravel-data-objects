<?php

declare(strict_types=1);

use IBroStudio\DataObjects\Rules\SshPrivateKeyRule;
use Illuminate\Validation\ValidationException;

it('passes validation with valid SshPrivateKeyRule', function () {
    Validator::make(
        [
            'attribute1' => getFakeSshPrivateKey(),
        ],
        [
            'attribute1' => new SshPrivateKeyRule(),
        ]
    )
        ->validate();

    expect(true)->toBeTrue();
});

it('fails validation with invalid value', function () {
    Validator::make(
        ['attribute' => 'invalid-value'],
        ['attribute' => new SshPrivateKeyRule()]
    )
        ->validate();
})->throws(ValidationException::class);
