<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Exceptions;

use Exception;
use Throwable;

class UnauthenticatableGBVatNumberException extends Exception
{
    public function __construct(string $message = 'GB VAT numbers can not be authenticated.', int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
