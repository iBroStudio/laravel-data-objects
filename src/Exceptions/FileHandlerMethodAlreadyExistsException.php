<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Exceptions;

use Exception;

class FileHandlerMethodAlreadyExistsException extends Exception
{
    public function __construct(string $name)
    {
        parent::__construct("Method \"{$name}\" already exists in this class.");
    }
}
