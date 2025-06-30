<?php

namespace IBroStudio\DataObjects\Concerns;

use IBroStudio\DataObjects\ValueObjects\TempFolder;

trait HasTempFolder
{
    private ?TempFolder $tempFolder = null;

    public function getTempFolder(): TempFolder
    {
        if (is_null($this->tempFolder)) {
            $this->tempFolder = TempFolder::make();
        }

        return $this->tempFolder;
    }
}
