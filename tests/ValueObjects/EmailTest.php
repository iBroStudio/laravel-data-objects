<?php

use IBroStudio\DataObjects\ValueObjects\Email;
use Illuminate\Validation\ValidationException;

it('can instantiate Email object value', function () {
    expect(
        Email::from('hello@ibro.studio')
    )->toBeInstanceOf(Email::class);
});

it('validate Email object value', function () {
    Email::from('invalid');
})->throws(ValidationException::class);

it('can return Email object value', function () {
    $email = 'hello@ibro.studio';

    expect(
        Email::from($email)->value
    )->toEqual($email);
});

it('can return Email object value single property', function () {
    $email = Email::from('hello@ibro.studio');

    expect($email->username)->toEqual('hello')
        ->and($email->domain)->toEqual('ibro.studio');
});

it('can return Email object value properties', function () {
    $email = 'hello@ibro.studio';

    expect(
        Email::from('hello@ibro.studio')->properties()
    )->toMatchArray([
        'value' => $email,
        'username' => 'hello',
        'domain' => 'ibro.studio',
    ]);
});
