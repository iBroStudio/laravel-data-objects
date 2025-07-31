<?php

declare(strict_types=1);

use IBroStudio\DataObjects\Rules\SshPublicKeyRule;
use Illuminate\Validation\ValidationException;

it('passes validation with valid SshPublicKeyRule', function () {
    Validator::make(
        [
            'attribute1' => getFakeSshPublicKey(),
        ],
        [
            'attribute1' => new SshPublicKeyRule(),
        ]
    )
        ->validate();

    expect(true)->toBeTrue();
});

it('fails validation with invalid value', function () {
    Validator::make(
        ['attribute' => 'invalid-value'],
        ['attribute' => new SshPublicKeyRule()]
    )
        ->validate();
})->throws(ValidationException::class);
