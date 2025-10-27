<?php

declare(strict_types=1);

use Brick\Math\RoundingMode;
use IBroStudio\DataObjects\ValueObjects\FloatValueObject;
use IBroStudio\DataObjects\ValueObjects\Percentage;
use Illuminate\Validation\ValidationException;

it('can instantiate Percentage object value', function () {
    expect(Percentage::from(fake()->randomFloat()))
        ->toBeInstanceOf(Percentage::class);
});

it('can validate Percentage object value', function () {
    Percentage::from('test');
})->throws(TypeError::class);

it('can return Percentage value', function () {
    expect(Percentage::from(19)->value)
        ->toBe(0.19);
});

it('can return Percentage formated value', function () {
    expect(Percentage::from(19)->format())
        ->toBe(19);
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

it('can return Percentage object value as array', function () {
    expect(
        Percentage::from(19.5)->toArray()
    )->toMatchArray([0.195]);
});

it('can return Percentage object from db property', function () {
    expect(Percentage::from([0.195])->format())
        ->toBe(19.5);
});
