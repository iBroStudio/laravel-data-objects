<?php

declare(strict_types=1);

use IBroStudio\DataObjects\Rules\IpAddressRule;
use Illuminate\Validation\ValidationException;

it('passes validation with valid IpAddressRule values', function () {
    Validator::make(
        [
            'attribute1' => '192.168.1.1',
            'attribute2' => '10.0.0.1',
            'attribute3' => '172.16.0.1',
            'attribute4' => '127.0.0.1',
            'attribute5' => '::1',

        ],
        [
            'attribute1' => new IpAddressRule(),
            'attribute2' => new IpAddressRule(),
            'attribute3' => new IpAddressRule(),
            'attribute4' => new IpAddressRule(),
            'attribute5' => new IpAddressRule(),
        ]
    )
        ->validate();

    expect(true)->toBeTrue();
});

it('passes validation with null value', function () {
    Validator::make(
        ['attribute' => null],
        ['attribute' => new IpAddressRule()]
    )
        ->validate();

    expect(true)->toBeTrue();
});

it('fails validation with invalid value', function () {
    Validator::make(
        ['attribute' => 'invalid-value'],
        ['attribute' => new IpAddressRule()]
    )
        ->validate();
})->throws(ValidationException::class);
