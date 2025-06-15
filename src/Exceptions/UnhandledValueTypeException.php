<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Exceptions;

use Exception;

class UnhandledValueTypeException extends Exception
{
    public function __construct(string $type)
    {
        parent::__construct("Value \"{$type}\" is not handled.");
    }
}
