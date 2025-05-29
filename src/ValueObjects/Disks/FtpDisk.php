<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\ValueObjects\Disks;

use IBroStudio\DataObjects\Dto\Disks\FtpDiskDto;

class FtpDisk extends Disk
{
    public function __construct(FtpDiskDto $properties)
    {
        parent::__construct($properties);
    }
}
