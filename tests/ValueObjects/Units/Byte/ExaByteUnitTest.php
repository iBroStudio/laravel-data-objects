<?php

use IBroStudio\DataObjects\ValueObjects\Units\Byte\ExaByteUnit;

it('can instantiate ExaByteUnit', function () {
    expect(ExaByteUnit::from(10))
        ->toBeInstanceOf(ExaByteUnit::class);
});

it('can return ExaByteUnit with unit', function () {
    expect(
        ExaByteUnit::from(10.00)->withUnit()
    )->toEqual('10EB')
        ->and(
            ExaByteUnit::from(10.58)->withUnit()
        )->toEqual('10.58EB')
        ->and(
            ExaByteUnit::from(10.50)->withUnit()
        )->toEqual('10.5EB');
});

it('can return ExaByteUnit unit', function () {
    expect(ExaByteUnit::unit())->toEqual('EB');
});
