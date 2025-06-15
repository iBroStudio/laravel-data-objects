<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Exceptions;

use Exception;

class FileHandlerPropertyNotFoundException extends Exception
{
    public function __construct(string $name)
    {
        parent::__construct("Property \"{$name}\" not found");
    }
}
