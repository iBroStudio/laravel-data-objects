<?php

declare(strict_types=1);

use IBroStudio\DataObjects\Exceptions\EmptyValueObjectException;
use IBroStudio\DataObjects\ValueObjects\EncryptableText;
use IBroStudio\DataObjects\ValueObjects\SshKey;
use Illuminate\Validation\ValidationException;

it('can instantiate SshKey object value', function (
    string $reference,
    EncryptableText|string|null $publicKey,
    EncryptableText|string|null $privateKey,
    EncryptableText|string|null $passphrase) {

    $ssh_key = SshKey::from(
        reference: $reference,
        publicKey: $publicKey,
        privateKey: $privateKey,
        passphrase: $passphrase,
    );

    expect($ssh_key)->toBeInstanceOf(SshKey::class);
})->with([
    'encrypted' => fn () => [
        fake()->userName,
        EncryptableText::from(getFakeSshPublicKey()),
        EncryptableText::from(getFakeSshPrivateKey()),
        EncryptableText::from(fake()->password),
    ],
    'strings' => fn () => [
        fake()->userName,
        getFakeSshPublicKey(),
        null,
        fake()->password,
    ],
    'nullable' => fn () => [
        fake()->userName,
        null,
        getFakeSshPrivateKey(),
        null,
    ],
]);

it('throws error if no key is provided', function () {
    SshKey::from(reference: fake()->userName());
})->throws(EmptyValueObjectException::class, 'Provide a public and/or a private SSH key.');

it('can validate public key', function () {
    SshKey::from(
        reference: fake()->userName,
        publicKey: fake()->uuid,
    );
})->throws(ValidationException::class, 'This is not a valid SSH public key.');

it('can validate private key', function () {
    SshKey::from(
        reference: fake()->uuid,
        privateKey: fake()->uuid,
    );
})->throws(ValidationException::class, 'This is not a valid SSH private key.');

it('can return SshKey object value single property', function () {
    $reference = fake()->uuid;
    $publicKey = getFakeSshPublicKey();
    $privateKey = getFakeSshPrivateKey();
    $passphrase = fake()->password;
    $ssh_key = SshKey::from(
        reference: $reference,
        publicKey: $publicKey,
        privateKey: $privateKey,
        passphrase: $passphrase,
    );

    expect($ssh_key->reference)->toBe($reference)
        ->and($ssh_key->publicKey->decrypt())->toBe($publicKey)
        ->and($ssh_key->privateKey->decrypt())->toBe($privateKey)
        ->and($ssh_key->passphrase->decrypt())->toBe($passphrase);
});

it('can return SshKey object value properties', function () {
    $reference = fake()->uuid;
    $publicKey = getFakeSshPublicKey();
    $privateKey = getFakeSshPrivateKey();
    $passphrase = fake()->password;
    $ssh_key = SshKey::from(
        reference: $reference,
        publicKey: $publicKey,
        privateKey: $privateKey,
        passphrase: $passphrase,
    );

    expect(
        $ssh_key->values()
    )->toMatchArray([
        'value' => $reference,
        'reference' => $reference,
        'publicKey' => $ssh_key->publicKey,
        'privateKey' => $ssh_key->privateKey,
        'passphrase' => $ssh_key->passphrase,
    ]);
});
