<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Facades;

use IBroStudio\DataObjects\Contracts\Handlers\File\FileHandlerContract;
use IBroStudio\DataObjects\Managers\FileHandlerManager;
use IBroStudio\DataObjects\ValueObjects\DataFile;
use Illuminate\Support\Facades\Facade;

/**
 * @method static FileHandlerContract handle(DataFile $dataFile)
 *
 * @see FileHandlerManager
 */
class FileHandler extends Facade
{
    protected static function getFacadeAccessor()
    {
        return FileHandlerManager::class;
    }
}
