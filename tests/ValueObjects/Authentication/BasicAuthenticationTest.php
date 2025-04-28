<?php

use IBroStudio\DataObjects\Exceptions\EmptyValueObjectException;
use IBroStudio\DataObjects\ValueObjects\Authentication\BasicAuthentication;
use IBroStudio\DataObjects\ValueObjects\EncryptableText;

it('can instantiate BasicAuthentication object value', function (string $username, EncryptableText|string $password) {
    expect(
        BasicAuthentication::from(
            username: $username,
            password: $password,
        )
    )->toBeInstanceOf(BasicAuthentication::class);
})->with([
    'encrypted' => fn () => [
        fake()->userName(),
        EncryptableText::from(fake()->password()),
    ],
    'strings' => fn () => [
        fake()->userName(),
        fake()->password(),
    ],
]);

it('can validate BasicAuthentication object value username', function () {
    BasicAuthentication::from(
        username: '',
        password: fake()->password(),
    );
})->throws(EmptyValueObjectException::class, 'Username cannot be empty.');

it('can validate BasicAuthentication object value password', function () {
    BasicAuthentication::from(
        username: fake()->userName(),
        password: '',
    );
})->throws(EmptyValueObjectException::class, 'Password cannot be empty.');

it('can return BasicAuthentication object value single property', function () {
    $username = fake()->userName();
    $password = fake()->password();
    $basicAuthentication = BasicAuthentication::from(
        username: $username,
        password: EncryptableText::from($password),
    );

    expect($basicAuthentication->username)->toBe($username)
        ->and($basicAuthentication->password->decrypt())->toBe($password);
});

it('can return BasicAuthentication object value properties', function () {
    $basicAuthentication = BasicAuthentication::from(
        username: fake()->userName(),
        password: EncryptableText::from(fake()->password()),
    );

    expect(
        $basicAuthentication->properties()
    )->toMatchArray([
        'value' => $basicAuthentication->value,
        'username' => $basicAuthentication->username,
        'password' => $basicAuthentication->password,
    ]);
});
