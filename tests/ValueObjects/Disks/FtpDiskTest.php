<?php

declare(strict_types=1);

use IBroStudio\DataObjects\Enums\DiskDriverEnum;
use IBroStudio\DataObjects\ValueObjects\Disks\Disk;
use IBroStudio\DataObjects\ValueObjects\Disks\FtpDisk;
use Illuminate\Contracts\Filesystem\Filesystem;

it('can instantiate Ftp Disk object value', function () {
    expect(Disk::from(ftp_properties()))->toBeInstanceOf(FtpDisk::class);
});

it('can return Ftp Disk Filesystem', function () {
    $disk = Disk::from(ftp_properties());

    expect($disk->filesystem)->toBeInstanceOf(Filesystem::class);
});

function ftp_properties(): array
{
    return [
        'driver' => DiskDriverEnum::Ftp,
        'host' => fake()->ipv4(),
        'auth' => [
            'username' => fake()->username(),
            'password' => fake()->password(),
        ],
    ];
}
