<?php

declare(strict_types=1);

use IBroStudio\DataObjects\ValueObjects\Units\Byte\GigaByteUnit;

it('can instantiate GigaByteUnit', function () {
    expect(GigaByteUnit::from(10))
        ->toBeInstanceOf(GigaByteUnit::class);
});

it('can return GigaByteUnit with unit', function () {
    expect(
        GigaByteUnit::from(10.00)->withUnit()
    )->toEqual('10GB')
        ->and(
            GigaByteUnit::from(10.58)->withUnit()
        )->toEqual('10.58GB')
        ->and(
            GigaByteUnit::from(10.50)->withUnit()
        )->toEqual('10.5GB');
});

it('can return GigaByteUnit unit', function () {
    expect(GigaByteUnit::unit())->toEqual('GB');
});
