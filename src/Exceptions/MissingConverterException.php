<?php

namespace IBroStudio\DataObjects\Exceptions;

use Exception;
use Throwable;

class MissingConverterException extends Exception
{
    public function __construct(string $message = 'No converter has been defined. Use DataPropertiesMapper->trough(Converter $converter) method.', int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
