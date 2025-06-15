<?php

declare(strict_types=1);

use IBroStudio\DataObjects\Enums\DiskDriverEnum;
use IBroStudio\DataObjects\ValueObjects\Disk;
use Illuminate\Contracts\Filesystem\Filesystem;

it('can instantiate Ftp Disk object value', function () {
    expect(Disk::from(...s3_properties()))->toBeInstanceOf(Disk::class);
});

it('can return Ftp Disk Filesystem', function () {
    $disk = Disk::from(...s3_properties());

    expect($disk->filesystem)->toBeInstanceOf(Filesystem::class);
});

function s3_properties(): array
{
    return [
        'driver' => DiskDriverEnum::S3,
        'auth' => [
            'key' => fake()->uuid(),
            'secret' => fake()->uuid(),
        ],
        'region' => 'us-east-1',
        'bucket' => fake()->word(),
    ];
}
