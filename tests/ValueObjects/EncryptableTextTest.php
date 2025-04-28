<?php

declare(strict_types=1);

use IBroStudio\DataObjects\ValueObjects\EncryptableText;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\ValidationException;

it('can instantiate EncryptableText object value', function () {
    $encryptableText = EncryptableText::from(fake()->word());

    expect($encryptableText)->toBeInstanceOf(EncryptableText::class);
});

it('can instantiate EncryptableText object value from encrypted string', function () {
    $encrypted = Crypt::encryptString(fake()->word());
    $encryptableText = EncryptableText::from($encrypted);

    expect($encryptableText)->toBeInstanceOf(EncryptableText::class);
});

it('can validate EncryptableText object value', function () {
    new EncryptableText(fake()->word());
})->throws(ValidationException::class);

it('can decrypt EncryptableText object value', function () {
    $text = fake()->word();
    $encryptableText = EncryptableText::from($text);

    expect($encryptableText->decrypt())->toEqual($text);
});
