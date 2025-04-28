<?php

declare(strict_types=1);

use Brick\Math\RoundingMode;
use IBroStudio\DataObjects\ValueObjects\FloatValueObject;
use Illuminate\Validation\ValidationException;

it('can instantiate Float object value', function () {
    expect(FloatValueObject::from(fake()->randomFloat()))
        ->toBeInstanceOf(FloatValueObject::class);
});

it('can validate Float object value', function () {
    FloatValueObject::from('test');
})->throws(ValidationException::class);

it('can return Float value', function () {
    expect(FloatValueObject::from(19)->value)
        ->toBeFloat();
});

it('can return Float object value as text', function () {
    expect(FloatValueObject::from(19.5)->toString())
        ->toBe('19.5');
});

it('can return null', function () {
    expect(FloatValueObject::fromOrNull(''))
        ->toBeNull();
});

it('can return Float object value as array', function () {
    expect(
        FloatValueObject::from(19.5)->toArray()
    )->toMatchArray([
        0 => 19.5,
    ]);
});

it('can return Integer object value as json', function () {
    expect(
        FloatValueObject::from(19.5)->toJson()
    )->toBe('[19.5]');
});

it('can calculate an addition', function () {
    expect(
        FloatValueObject::from(19.5)->plus(1.2)
    )->toBe(20.7);
});

it('can calculate a subtraction', function () {
    expect(
        FloatValueObject::from(19.5)->minus(1.2)
    )->toBe(18.3);
});

it('can calculate a division', function () {
    expect(
        FloatValueObject::from(19.5)->dividedBy(3)
    )->toBe(6.5);
});

it('can calculate a division with rounding instruction', function () {
    expect(
        FloatValueObject::from(19.5)->dividedBy(4, null, RoundingMode::HALF_EVEN)
    )->toBe(4.9);
});

it('can calculate a multiplication', function () {
    expect(
        FloatValueObject::from(19.5)->multipliedBy(3)
    )->toBe(58.5);
});
