<?php

declare(strict_types=1);

use IBroStudio\DataObjects\Exceptions\EmptyValueObjectException;
use IBroStudio\DataObjects\ValueObjects\Authentication\S3Authentication;
use IBroStudio\DataObjects\ValueObjects\EncryptableText;

it('can instantiate S3Authentication object value', function (string $key, EncryptableText|string $secret) {
    $s3Authentication = S3Authentication::from(
        key: $key,
        secret: $secret,
    );

    expect($s3Authentication)->toBeInstanceOf(S3Authentication::class);
})->with([
    'encrypted' => fn () => [
        fake()->uuid(),
        EncryptableText::from(fake()->password()),
    ],
    'strings' => fn () => [
        fake()->uuid(),
        fake()->password(),
    ],
]);

it('can validate S3Authentication object value username', function () {
    S3Authentication::from(
        key: '',
        secret: fake()->password(),
    );
})->throws(EmptyValueObjectException::class, 'Key cannot be empty.');

it('can validate S3Authentication object value password', function () {
    S3Authentication::from(
        key: fake()->uuid(),
        secret: '',
    );
})->throws(EmptyValueObjectException::class, 'Secret cannot be empty.');

it('can return S3Authentication object value single property', function () {
    $key = fake()->uuid();
    $secret = fake()->password();
    $S3Authentication = S3Authentication::from(
        key: $key,
        secret: EncryptableText::from($secret),
    );

    expect($S3Authentication->key)->toBe($key)
        ->and($S3Authentication->secret->decrypt())->toBe($secret);
});

it('can return S3Authentication object value properties', function () {
    $S3Authentication = S3Authentication::from(
        key: fake()->uuid(),
        secret: EncryptableText::from(fake()->password()),
    );

    expect(
        $S3Authentication->values()
    )->toMatchArray([
        'value' => $S3Authentication->value,
        'key' => $S3Authentication->key,
        'secret' => $S3Authentication->secret,
    ]);
});
