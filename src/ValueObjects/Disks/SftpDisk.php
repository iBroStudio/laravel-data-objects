<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\ValueObjects\Disks;

use IBroStudio\DataObjects\Dto\Disks\SftpDiskDto;

class SftpDisk extends Disk
{
    public function __construct(SftpDiskDto $properties)
    {
        parent::__construct($properties);
    }
}
