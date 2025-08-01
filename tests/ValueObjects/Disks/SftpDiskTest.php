<?php

declare(strict_types=1);

use IBroStudio\DataObjects\Enums\DiskDriverEnum;
use IBroStudio\DataObjects\ValueObjects\Disk;
use Illuminate\Contracts\Filesystem\Filesystem;

it('can instantiate Ftp Disk object value with basic auth', function () {
    $disk = Disk::from(...sftp_basic_properties());

    expect($disk)->toBeInstanceOf(Disk::class)
        ->and($disk->filesystem)
        ->toBeInstanceOf(Filesystem::class);
});

it('can instantiate Ftp Disk object value with ssh auth', function () {
    $disk = Disk::from(...sftp_ssh_properties());

    expect($disk)->toBeInstanceOf(Disk::class)
        ->and($disk->filesystem)
        ->toBeInstanceOf(Filesystem::class);
});

function sftp_basic_properties(): array
{
    return [
        'driver' => DiskDriverEnum::Sftp,
        'host' => fake()->ipv4(),
        'auth' => [
            'username' => fake()->username(),
            'password' => fake()->password(),
        ],
    ];
}

function sftp_ssh_properties(): array
{
    return [
        'driver' => DiskDriverEnum::Sftp,
        'host' => fake()->ipv4(),
        'auth' => [
            'username' => fake()->username,
            'sshKey' => [
                'reference' => fake()->uuid,
                'publicKey' => getFakeSshPublicKey(),
            ],
        ],
    ];
}
