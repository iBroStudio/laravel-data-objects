<?php

declare(strict_types=1);

use ByteUnits\Metric;
use IBroStudio\DataObjects\Enums\ByteUnitEnum;
use IBroStudio\DataObjects\ValueObjects\Units\Byte\ByteUnit;
use Illuminate\Validation\ValidationException;

it('can instantiate ByteUnit from string', function () {
    expect(
        ByteUnit::from('1.42MB')
    )->toBeInstanceOf(ByteUnit::class);
});

it('can instantiate ByteUnit from Metric', function () {
    expect(
        ByteUnit::from(Metric::gigabytes(12))
    )->toBeInstanceOf(ByteUnit::class);
});

it('can instantiate ByteUnit from number', function () {
    expect(
        ByteUnit::from(12.5)
    )->toBeInstanceOf(ByteUnit::class);
});

it('can validate ByteUnit', function () {
    ByteUnit::from('aaa');
})->throws(ValidationException::class);

it('can return ByteUnit value', function () {
    expect(
        ByteUnit::from('1.42MB')->value
    )->toEqual(1.42);
});

it('can return ByteUnit with unit', function () {
    expect(
        ByteUnit::from('1.42MB')->withUnit()
    )->toEqual('1.42MB');
});

it('can return ByteUnit unit', function () {
    expect(ByteUnit::unit())->toEqual('B');
});

it('can convert ByteUnit', function () {
    expect(
        ByteUnit::from('120MB')->convertIn(ByteUnitEnum::GB)
    )->toEqual('0.12GB');
});

it('can compare ByteUnit values', function () {
    $value = ByteUnit::from('1.42MB');
    $value2 = ByteUnit::from('2GB');
    $value3 = ByteUnit::from('100B');

    expect($value->isEqualTo($value))->toBeTrue()
        ->and($value->isLessThanOrEqualTo($value))->toBeTrue()
        ->and($value->isLessThan($value))->toBeFalse()
        ->and($value->isGreaterThanOrEqualTo($value))->toBeTrue()
        ->and($value->isGreaterThan($value))->toBeFalse()
        ->and($value->isEqualTo($value3))->toBeFalse()
        ->and($value->isLessThanOrEqualTo($value3))->toBeFalse()
        ->and($value->isLessThan($value3))->toBeFalse()
        ->and($value->isGreaterThanOrEqualTo($value3))->toBeTrue()
        ->and($value->isGreaterThan($value3))->toBeTrue()
        ->and($value->isEqualTo($value2))->toBeFalse()
        ->and($value->isLessThanOrEqualTo($value2))->toBeTrue()
        ->and($value->isLessThan($value2))->toBeTrue()
        ->and($value->isGreaterThanOrEqualTo($value2))->toBeFalse()
        ->and($value->isGreaterThan($value2))->toBeFalse();
});
