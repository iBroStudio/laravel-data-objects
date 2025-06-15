<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Exceptions;

use Exception;

class FileDoesNotExistException extends Exception
{
    public function __construct(string $file)
    {
        parent::__construct("File {$file} does not exist");
    }
}
