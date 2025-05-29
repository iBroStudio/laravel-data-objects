<?php

declare(strict_types=1);

use IBroStudio\DataObjects\Terminal\ValidateSshPrivateKey;
use IBroStudio\DataObjects\Terminal\ValidateSshPublicKey;
use Illuminate\Support\Facades\File;

it('can validate a public ssh key', function () {
    File::deleteDirectory(storage_path('ssh'));
    $validate = new ValidateSshPublicKey(getFakeSshPublicKey());

    expect($validate())->toBeTruthy()
        ->and(
            File::allFiles(storage_path('ssh'))
        )->toBeEmpty();
});

it('can validate a private ssh key', function () {
    File::deleteDirectory(storage_path('ssh'));
    $validate = new ValidateSshPrivateKey(getFakeSshPrivateKey());

    expect($validate())->toBeTruthy()
        ->and(
            File::allFiles(storage_path('ssh'))
        )->toBeEmpty();
});

it('can not validate an invalid public ssh key', function () {
    File::deleteDirectory(storage_path('ssh'));
    $validate = new ValidateSshPublicKey(fake()->uuid());

    expect($validate())->toBeFalsy()
        ->and(
            File::allFiles(storage_path('ssh'))
        )->toBeEmpty();
});

it('can not validate an invalid private ssh key', function () {
    File::deleteDirectory(storage_path('ssh'));
    $validate = new ValidateSshPrivateKey(fake()->uuid());

    expect($validate())->toBeFalsy()
        ->and(
            File::allFiles(storage_path('ssh'))
        )->toBeEmpty();
});
