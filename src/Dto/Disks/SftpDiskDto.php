<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Dto\Disks;

use IBroStudio\DataObjects\Concerns\DiskDtoWithAuth;
use IBroStudio\DataObjects\Contracts\DiskDtoContract;
use IBroStudio\DataObjects\Enums\DiskDriverEnum;
use IBroStudio\DataObjects\ValueObjects\Authentication\AuthenticationAbstract;
use Spatie\LaravelData\Data;

class SftpDiskDto extends Data implements DiskDtoContract
{
    use DiskDtoWithAuth;

    public function __construct(
        public DiskDriverEnum $driver,
        public string $host,
        public AuthenticationAbstract $auth,
        public int $port = 22,
        public string $root = '/',
        public bool $useAgent = true,
    ) {}
}
