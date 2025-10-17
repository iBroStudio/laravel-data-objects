<?php

declare(strict_types=1);

use IBroStudio\DataObjects\ValueObjects\Phone;
use Illuminate\Validation\ValidationException;
use libphonenumber\PhoneNumberType;

it('can instantiate Phone object value', function () {
    expect(
        Phone::from('+33102030405')
    )->toBeInstanceOf(Phone::class)
        ->and(
            Phone::from('0102030405', 'FR')
        )->toBeInstanceOf(Phone::class);

});

it('validate Phone object value', function () {
    Phone::from('invalid number');
})->throws(ValidationException::class);

it('validate Phone country', function () {
    Phone::from('0102030405');
})->throws(ValidationException::class, 'Missing or invalid default region.');

it('can return Phone object value', function () {
    $phone = '+33102030405';

    expect(
        Phone::from($phone)->value
    )->toEqual($phone);

    $phone = '0102030405';

    expect(
        Phone::from($phone, 'FR')->value
    )->toEqual('+33102030405');
});

it('can return Phone object value single property', function () {
    $url = Phone::from('+33102030405');

    expect($url->national)->toEqual('01 02 03 04 05')
        ->and($url->international)->toEqual('+33 1 02 03 04 05')
        ->and($url->type)->toEqual(PhoneNumberType::FIXED_LINE)
        ->and($url->country)->toEqual('FR');

    $url = Phone::from('0102030405', 'FR');

    expect($url->national)->toEqual('01 02 03 04 05')
        ->and($url->international)->toEqual('+33 1 02 03 04 05')
        ->and($url->type)->toEqual(PhoneNumberType::FIXED_LINE)
        ->and($url->country)->toEqual('FR');
});

it('can return Phone object value properties', function () {
    $phone = '+33102030405';

    expect(
        Phone::from($phone)
            ->values()
    )->toMatchArray([
        'value' => $phone,
        'national' => '01 02 03 04 05',
        'international' => '+33 1 02 03 04 05',
        'type' => PhoneNumberType::FIXED_LINE,
        'country' => 'FR',
    ]);
});
