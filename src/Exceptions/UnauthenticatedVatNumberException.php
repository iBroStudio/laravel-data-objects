<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Exceptions;

use Exception;
use Throwable;

class UnauthenticatedVatNumberException extends Exception
{
    public function __construct(string $message = 'VAT number not invalid.', int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
