<?php

declare(strict_types=1);

use IBroStudio\DataObjects\ValueObjects\Authentication\SshAuthentication;
use IBroStudio\DataObjects\ValueObjects\SshKey;

it('can instantiate SshAuthentication object value', function () {
    $ssh_key = SshKey::from(
        reference: fake()->uuid,
        publicKey: getFakeSshPublicKey(),
        privateKey: getFakeSshPrivateKey(),
        passphrase: fake()->password,
    );

    $ssh_auth = SshAuthentication::from(
        username: fake()->userName,
        sshKey: $ssh_key,
    );

    expect($ssh_auth)->toBeInstanceOf(SshAuthentication::class);
});

it('can return SshAuthentication object value single property', function () {
    $reference = fake()->uuid;
    $username = fake()->userName;
    $publicKey = getFakeSshPublicKey();
    $privateKey = getFakeSshPrivateKey();
    $passphrase = fake()->password;

    $ssh_key = SshKey::from(
        reference: $reference,
        publicKey: $publicKey,
        privateKey: $privateKey,
        passphrase: $passphrase,
    );

    $ssh_auth = SshAuthentication::from(
        username: $username,
        sshKey: $ssh_key,
    );

    expect($ssh_auth->username)->toBe($username)
        ->and($ssh_auth->sshKey->reference)->toBe($reference)
        ->and($ssh_auth->sshKey->publicKey->decrypt())->toBe($publicKey)
        ->and($ssh_auth->sshKey->privateKey->decrypt())->toBe($privateKey)
        ->and($ssh_auth->sshKey->passphrase->decrypt())->toBe($passphrase);
});

it('can return SshKey object value properties', function () {
    $reference = fake()->uuid;
    $username = fake()->userName;
    $publicKey = getFakeSshPublicKey();
    $privateKey = getFakeSshPrivateKey();
    $passphrase = fake()->password;

    $ssh_key = SshKey::from(
        reference: $reference,
        publicKey: $publicKey,
        privateKey: $privateKey,
        passphrase: $passphrase,
    );

    $ssh_auth = SshAuthentication::from(
        username: $username,
        sshKey: $ssh_key,
    );

    expect(
        $ssh_auth->values()
    )->toMatchArray([
        'value' => $username,
        'username' => $username,
        'sshKey' => $ssh_key,
    ]);
});
