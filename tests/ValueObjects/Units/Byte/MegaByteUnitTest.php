<?php

declare(strict_types=1);

use IBroStudio\DataObjects\ValueObjects\Units\Byte\MegaByteUnit;

it('can instantiate MegaByteUnit', function () {
    expect(MegaByteUnit::from(10))
        ->toBeInstanceOf(MegaByteUnit::class);
});

it('can return MegaByteUnit with unit', function () {
    expect(
        MegaByteUnit::from(10.00)->withUnit()
    )->toEqual('10MB')
        ->and(
            MegaByteUnit::from(10.58)->withUnit()
        )->toEqual('10.58MB')
        ->and(
            MegaByteUnit::from(10.50)->withUnit()
        )->toEqual('10.5MB');
});

it('can return MegaByteUnit unit', function () {
    expect(MegaByteUnit::unit())->toEqual('MB');
});
