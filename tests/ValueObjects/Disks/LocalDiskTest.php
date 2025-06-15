<?php

declare(strict_types=1);

use IBroStudio\DataObjects\Enums\DiskDriverEnum;
use IBroStudio\DataObjects\ValueObjects\Disk;
use Illuminate\Contracts\Filesystem\Filesystem;

it('can instantiate Local Disk object value', function () {
    expect(Disk::from(...local_properties()))->toBeInstanceOf(Disk::class);
});

it('can return Local Disk Filesystem', function () {
    $disk = Disk::from(...local_properties());

    expect($disk->filesystem)->toBeInstanceOf(Filesystem::class);
});

function local_properties(): array
{
    return [
        'driver' => DiskDriverEnum::Local,
        'root' => __DIR__.'/../../Support',
    ];
}
