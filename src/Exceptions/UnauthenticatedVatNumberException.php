<?php

namespace IBroStudio\DataObjects\Exceptions;

use Exception;
use Throwable;

class UnauthenticatedVatNumberException extends Exception
{
    public function __construct(string $message = 'VAT number is invalid.', int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
