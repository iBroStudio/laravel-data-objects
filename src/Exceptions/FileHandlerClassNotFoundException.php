<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Exceptions;

use Exception;

class FileHandlerClassNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct('Class not found');
    }
}
