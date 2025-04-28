<?php

use IBroStudio\DataObjects\ValueObjects\Phone;
use Illuminate\Validation\ValidationException;

it('can instantiate Phone object value', function () {
    expect(
        Phone::from('+33102030405')
    )->toBeInstanceOf(Phone::class);
});

it('validate Phone object value', function () {
    Phone::from('invalid number');
})->throws(ValidationException::class);

it('can return Phone object value', function () {
    $phone = '+33102030405';

    expect(
        Phone::from($phone)->value
    )->toEqual($phone);
});

it('can return Phone object value single property', function () {
    $url = Phone::from('+33102030405');

    expect($url->national)->toEqual('01 02 03 04 05')
        ->and($url->international)->toEqual('+33 1 02 03 04 05')
        ->and($url->type)->toEqual('fixed_line')
        ->and($url->country)->toEqual('FR');
});

it('can return Phone object value properties', function () {
    $phone = '+33102030405';

    expect(
        Phone::from($phone)
            ->properties()
    )->toMatchArray([
        'value' => $phone,
        'national' => '01 02 03 04 05',
        'international' => '+33 1 02 03 04 05',
        'type' => 'fixed_line',
        'country' => 'FR',
    ]);
});
