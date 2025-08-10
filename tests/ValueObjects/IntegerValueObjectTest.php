<?php

declare(strict_types=1);

use Brick\Math\RoundingMode;
use IBroStudio\DataObjects\ValueObjects\IntegerValueObject;
use Illuminate\Validation\ValidationException;

it('can instantiate Integer object value', function () {
    expect(IntegerValueObject::from(fake()->randomNumber()))
        ->toBeInstanceOf(IntegerValueObject::class);
});

it('can validate Integer object value', function () {
    IntegerValueObject::from('test');
})->throws(ValidationException::class);

it('can return Integer value', function () {
    expect(IntegerValueObject::from(19)->value)
        ->toBeInt();
});

it('can return Integer object value as text', function () {
    expect(IntegerValueObject::from(19)->toString())
        ->toBe('19');
});

it('can return null', function () {
    expect(IntegerValueObject::fromOrNull(''))
        ->toBeNull();
});

it('can return Integer object value as array', function () {
    expect(
        IntegerValueObject::from(19)->toArray()
    )->toMatchArray([
        0 => 19,
    ]);
});

it('can return Integer object value as json', function () {
    expect(
        IntegerValueObject::from(19)->toJson()
    )->toBe('19');
});

it('can calculate an addition', function () {
    expect(
        IntegerValueObject::from(19)->plus(1)
    )->toBe(20);
});

it('can calculate a subtraction', function () {
    expect(
        IntegerValueObject::from(19)->minus(1)
    )->toBe(18);
});

it('can calculate a division', function () {
    expect(
        IntegerValueObject::from(18)->dividedBy(3)
    )->toBe(6);
});

it('can calculate a rounded division', function () {
    expect(
        IntegerValueObject::from(18)->dividedBy(4, RoundingMode::HALF_EVEN)
    )->toBe(4);
});

it('can calculate a multiplication', function () {
    expect(
        IntegerValueObject::from(19)->multipliedBy(2)
    )->toBe(38);
});
