<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Dto\Disks;

use IBroStudio\DataObjects\Concerns\DiskDtoWithAuth;
use IBroStudio\DataObjects\Contracts\DiskDtoContract;
use IBroStudio\DataObjects\Enums\DiskDriverEnum;
use IBroStudio\DataObjects\ValueObjects\Authentication\BasicAuthentication;
use Spatie\LaravelData\Data;

class FtpDiskDto extends Data implements DiskDtoContract
{
    use DiskDtoWithAuth;

    public function __construct(
        public DiskDriverEnum $driver,
        public string $host,
        public BasicAuthentication $auth,
        public int $port = 21,
        public string $root = '/',
    ) {}
}
