<?php

use IBroStudio\DataObjects\ValueObjects\Units\DecimalUnit;

it('can instantiate DecimalUnit', function () {
    expect(DecimalUnit::from(10.46))
        ->toBeInstanceOf(DecimalUnit::class);
});

it('can return DecimalUnit with unit', function () {
    expect(
        DecimalUnit::from(10.00)->withUnit()
    )->toEqual('10')
        ->and(
            DecimalUnit::from(10.58)->withUnit()
        )->toEqual('10.58')
        ->and(
            DecimalUnit::from(10.50)->withUnit()
        )->toEqual('10.5');
});

it('can return DecimalUnit unit', function () {
    expect(DecimalUnit::unit())
        ->toBeNull();
});
