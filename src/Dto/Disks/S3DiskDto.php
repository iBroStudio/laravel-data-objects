<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Dto\Disks;

use IBroStudio\DataObjects\Concerns\DiskDtoWithAuth;
use IBroStudio\DataObjects\Contracts\DiskDtoContract;
use IBroStudio\DataObjects\Enums\DiskDriverEnum;
use IBroStudio\DataObjects\ValueObjects\Authentication\S3Authentication;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class S3DiskDto extends Data implements DiskDtoContract
{
    use DiskDtoWithAuth;

    public function __construct(
        public DiskDriverEnum $driver,
        public S3Authentication $auth,
        public string $region,
        public string $bucket,
        public string|Optional $endpoint,
        public string|Optional $url,
    ) {}
}
