<?php

declare(strict_types=1);

use IBroStudio\DataObjects\Enums\DiskDriverEnum;
use IBroStudio\DataObjects\ValueObjects\Disks\Disk;
use IBroStudio\DataObjects\ValueObjects\Disks\LocalDisk;
use Illuminate\Contracts\Filesystem\Filesystem;

it('can instantiate Local Disk object value', function () {
    expect(Disk::from(local_properties()))->toBeInstanceOf(LocalDisk::class);
});

it('can return Local Disk Filesystem', function () {
    $disk = Disk::from(local_properties());

    expect($disk->filesystem)->toBeInstanceOf(Filesystem::class);
});

function local_properties(): array
{
    return [
        'driver' => DiskDriverEnum::Local,
        'root' => __DIR__.'/../../Support',
    ];
}
