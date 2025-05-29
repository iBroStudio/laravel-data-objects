<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Concerns;

trait DiskDtoWithAuth
{
    public function toDiskConfig(): array
    {
        return $this
            ->additional($this->auth->toDecryptedArray())
            ->except('auth')
            ->toArray();
    }
}
