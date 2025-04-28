<?php

use IBroStudio\DataObjects\Rules\IsEncryptedRule;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

it('can validate encrypted value', function () {
    $value = fake()->word();
    $encrypted = Crypt::encryptString($value);
    $validator = Validator::make(['value' => $encrypted], [
        'value' => new IsEncryptedRule,
    ]);

    expect($validator->fails())->toBeFalse();
});

it('fails validating uncrypted value', function () {
    $value = fake()->word();
    $validator = Validator::make(['value' => $value], [
        'value' => new IsEncryptedRule,
    ]);

    expect($validator->fails())->toBeTrue();
});
