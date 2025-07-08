<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Concerns;

use IBroStudio\DataObjects\ValueObjects\TempFolder;

trait HasTempFolder
{
    private ?TempFolder $tempFolder = null;

    public function getTempFolder(string $name = '',
        string $location = '',
        bool $deleteWhenDestroyed = true): TempFolder
    {
        if (is_null($this->tempFolder)) {
            $this->tempFolder = TempFolder::from($name, $location, $deleteWhenDestroyed);
        }

        return $this->tempFolder;
    }
}
