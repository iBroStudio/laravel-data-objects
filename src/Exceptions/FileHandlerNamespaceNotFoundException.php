<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Exceptions;

use Exception;

class FileHandlerNamespaceNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct('Namespace not found');
    }
}
