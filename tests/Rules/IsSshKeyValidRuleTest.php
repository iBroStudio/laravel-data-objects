<?php

declare(strict_types=1);

use IBroStudio\DataObjects\Rules\IsSshKeyValidRule;

it('can validate ssh key', function () {
    $value = fake()->sshKey();
    $validator = Validator::make(['value' => $value], [
        'value' => new IsSshKeyValidRule,
    ]);

    expect($validator->fails())->toBeFalse();
});

it('fails validating unvalid ssh key', function () {
    $value = fake()->uuid();
    $validator = Validator::make(['value' => $value], [
        'value' => new IsSshKeyValidRule,
    ]);

    expect($validator->fails())->toBeTrue();
});
