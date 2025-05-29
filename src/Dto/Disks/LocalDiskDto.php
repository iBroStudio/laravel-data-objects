<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Dto\Disks;

use IBroStudio\DataObjects\Contracts\DiskDtoContract;
use IBroStudio\DataObjects\Enums\DiskDriverEnum;
use Spatie\LaravelData\Data;

class LocalDiskDto extends Data implements DiskDtoContract
{
    public function __construct(
        public DiskDriverEnum $driver,
        public string $root,
    ) {}

    public function toDiskConfig(): array
    {
        return $this->toArray();
    }
}
