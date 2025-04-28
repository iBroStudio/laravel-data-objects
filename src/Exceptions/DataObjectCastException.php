<?php

namespace IBroStudio\DataObjects\Exceptions;

use Exception;

class DataObjectCastException extends Exception
{
    public function __construct(string $given, string $expected)
    {
        parent::__construct("{$given} is not a {$expected}");
    }
}
