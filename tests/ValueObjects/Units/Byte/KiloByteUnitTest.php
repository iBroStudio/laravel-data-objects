<?php

declare(strict_types=1);

use IBroStudio\DataObjects\ValueObjects\Units\Byte\KiloByteUnit;

it('can instantiate KiloByteUnit', function () {
    expect(KiloByteUnit::from(10))
        ->toBeInstanceOf(KiloByteUnit::class);
});

it('can return KiloByteUnit with unit', function () {
    expect(
        KiloByteUnit::from(10.00)->withUnit()
    )->toEqual('10kB')
        ->and(
            KiloByteUnit::from(10.58)->withUnit()
        )->toEqual('10.58kB')
        ->and(
            KiloByteUnit::from(10.50)->withUnit()
        )->toEqual('10.5kB');
});

it('can return KiloByteUnit unit', function () {
    expect(KiloByteUnit::unit())->toEqual('kB');
});
