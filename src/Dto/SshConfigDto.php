<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Dto;

use IBroStudio\DataObjects\ValueObjects\Authentication\SshKey;
use IBroStudio\DataObjects\ValueObjects\Domain;
use IBroStudio\DataObjects\ValueObjects\IpAddress;
use Spatie\LaravelData\Data;

class SshConfigDto extends Data
{
    public function __construct(
        public IpAddress|Domain $host,
        public SshKey $key,
        public int $port = 22
    ) {}
}
