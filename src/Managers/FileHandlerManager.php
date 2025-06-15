<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Managers;

use IBroStudio\DataObjects\Contracts\Handlers\File\FileHandlerContract;
use IBroStudio\DataObjects\Handlers\File\DefaultFileHandler;
use IBroStudio\DataObjects\Handlers\File\PhpFileHandler;
use IBroStudio\DataObjects\ValueObjects\DataFile;
use Illuminate\Support\Manager;

class FileHandlerManager extends Manager
{
    private DataFile $dataFile;

    public function handle(DataFile $dataFile): FileHandlerContract
    {
        $this->dataFile = $dataFile;

        return $this->createDriver($this->dataFile->fileHandlerDriverEnum->getDriver());
    }

    public function getDefaultDriver()
    {
        return 'default';
    }

    public function createDefaultDriver(): FileHandlerContract
    {
        return new DefaultFileHandler($this->dataFile);
    }

    public function createPhpDriver(): FileHandlerContract
    {
        return new PhpFileHandler($this->dataFile);
    }
}
