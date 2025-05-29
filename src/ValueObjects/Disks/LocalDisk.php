<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\ValueObjects\Disks;

use IBroStudio\DataObjects\Dto\Disks\LocalDiskDto;

class LocalDisk extends Disk
{
    public function __construct(LocalDiskDto $properties)
    {
        parent::__construct($properties);
    }
}
