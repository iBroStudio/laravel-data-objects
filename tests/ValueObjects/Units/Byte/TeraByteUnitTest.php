<?php

use IBroStudio\DataObjects\ValueObjects\Units\Byte\TeraByteUnit;

it('can instantiate TeraByteUnit', function () {
    expect(TeraByteUnit::from(10))
        ->toBeInstanceOf(TeraByteUnit::class);
});

it('can return TeraByteUnit with unit', function () {
    expect(
        TeraByteUnit::from(10.00)->withUnit()
    )->toEqual('10TB')
        ->and(
            TeraByteUnit::from(10.58)->withUnit()
        )->toEqual('10.58TB')
        ->and(
            TeraByteUnit::from(10.50)->withUnit()
        )->toEqual('10.5TB');
});

it('can return TeraByteUnit unit', function () {
    expect(TeraByteUnit::unit())->toEqual('TB');
});
