<?php

declare(strict_types=1);

use IBroStudio\DataObjects\ValueObjects\Boolean;
use Illuminate\Validation\ValidationException;

it('can instantiate Boolean object value from boolean', function () {
    expect(Boolean::from(true))
        ->toBeInstanceOf(Boolean::class);
});

it('can handle string argument', function (string $value) {
    expect(
        Boolean::from($value)->value
    )->toBeBool();
})->with(['1', 'true', 'on', 'yes', '0', 'false', 'off', 'no']);

it('can validate Boolean object value', function () {
    Boolean::from('');
})->throws(ValidationException::class);

it('can return Boolean object value as text', function () {
    expect(Boolean::from(true)->toString())
        ->toBe('true')
        ->and(Boolean::from(false)->toString())
        ->toBe('false');
});

it('can return null', function () {
    expect(Boolean::fromOrNull(''))
        ->toBeNull();
});
