<?php

declare(strict_types=1);

use IBroStudio\DataObjects\ValueObjects\Percentage;
use Illuminate\Validation\ValidationException;

it('can instantiate Percentage object value', function () {
    expect(Percentage::from(fake()->randomFloat()))
        ->toBeInstanceOf(Percentage::class)
        ->and(Percentage::from(fake()->numberBetween(0, 100)))
        ->toBeInstanceOf(Percentage::class);

});

it('can validate Percentage object value', function () {
    Percentage::from('test');
})->throws(ValidationException::class);

it('can return Percentage value', function () {
    expect(Percentage::from(19)->value)
        ->toBe(19);
});

it('can return Percentage quotient value', function () {
    expect(Percentage::from(19)->getQuotient())
        ->toBe(0.19);
});

it('can return the percentage of a number', function () {
    expect(Percentage::from(25)->of(200))
        ->toEqual(50);
});

it('can return Percentage object value as text', function () {
    expect(Percentage::from(19)->toString())
        ->toBe('19%');
    expect(Percentage::from(19.5)->toString())
        ->toBe('19.5%');
});

it('can return null', function () {
    expect(Percentage::fromOrNull(''))
        ->toBeNull();
});
