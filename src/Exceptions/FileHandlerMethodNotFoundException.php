<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Exceptions;

use Exception;

class FileHandlerMethodNotFoundException extends Exception
{
    public function __construct(string $name)
    {
        parent::__construct("Method \"{$name}\" not found");
    }
}
