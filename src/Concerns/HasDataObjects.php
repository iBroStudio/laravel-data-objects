<?php

namespace IBroStudio\DataObjects\Concerns;

use IBroStudio\DataObjects\Contracts\DataObjectConfigDTOContract;

trait HasDataObjects
{
    public DataObjectConfigDTOContract $dataObjectConfig;

    // abstract protected function configureDataObjects(): void;
}
