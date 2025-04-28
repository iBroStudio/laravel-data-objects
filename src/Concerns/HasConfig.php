<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Concerns;

use IBroStudio\DataObjects\Contracts\ModelConfigDTOContract;

trait HasConfig
{
    public ModelConfigDTOContract $config;

    abstract protected function getConfig(): ModelConfigDTOContract;

    public function initializeHasConfig(): void
    {
        $this->config = $this->getConfig();

        $this->mergeCasts(
            $this->config->getCasts()->toArray()
        );
    }
}
