<?php

use IBroStudio\DataObjects\DTO\VatNumberAuthenticationDTO;
use IBroStudio\DataObjects\Exceptions\UnauthenticatableGBVatNumberException;
use IBroStudio\DataObjects\Exceptions\UnauthenticatedVatNumberException;
use IBroStudio\DataObjects\ValueObjects\VatNumber;
use Illuminate\Validation\ValidationException;

it('can instantiate VatNumber object value', function () {
    expect(VatNumber::from('FR54879706885'))
        ->toBeInstanceOf(VatNumber::class);
});

it('can return VatNumber object value', function () {
    expect(
        VatNumber::from('FR54879706885')->value
    )->toEqual('FR54879706885');
});

it('can validate VatNumber object value', function () {
    VatNumber::from('invalid vat number');
})->throws(ValidationException::class);

it('can authenticated VatNumber object value', function () {
    expect(
        VatNumber::from('FR54879706885')->authenticate()
    )->toBeInstanceOf(VatNumberAuthenticationDTO::class);
});

it('can not authenticated invalid VatNumber object value', function () {
    VatNumber::from('FR00000000000')->authenticate();
})->throws(UnauthenticatedVatNumberException::class);

it('can not authenticated GB VatNumber object value', function () {
    VatNumber::from('GB 553557881')->authenticate();
})->throws(UnauthenticatableGBVatNumberException::class);

it('can return VatNumber object value single property', function () {
    $vat = VatNumber::from('FR54879706885');

    expect($vat->number)->toEqual('54879706885')
        ->and($vat->country)->toEqual('FR');
});

it('can return VatNumber object value properties', function () {
    $vat = 'FR54879706885';

    expect(
        VatNumber::from($vat)
            ->properties()
    )->toMatchArray([
        'value' => $vat,
        'number' => '54879706885',
        'country' => 'FR',
    ]);
});
