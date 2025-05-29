<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Contracts;

interface DiskDtoContract
{
    public function toDiskConfig(): array;
}
