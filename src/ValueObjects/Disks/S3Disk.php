<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\ValueObjects\Disks;

use IBroStudio\DataObjects\Dto\Disks\S3DiskDto;

class S3Disk extends Disk
{
    public function __construct(S3DiskDto $properties)
    {
        parent::__construct($properties);
    }
}
