<?php

declare(strict_types=1);

use IBroStudio\DataObjects\ValueObjects\Units\Byte\PetaByteUnit;

it('can instantiate PetaByteUnit', function () {
    expect(PetaByteUnit::from(10))
        ->toBeInstanceOf(PetaByteUnit::class);
});

it('can return PetaByteUnit with unit', function () {
    expect(
        PetaByteUnit::from(10.00)->withUnit()
    )->toEqual('10PB')
        ->and(
            PetaByteUnit::from(10.58)->withUnit()
        )->toEqual('10.58PB')
        ->and(
            PetaByteUnit::from(10.50)->withUnit()
        )->toEqual('10.5PB');
});

it('can return PetaByteUnit unit', function () {
    expect(PetaByteUnit::unit())->toEqual('PB');
});
