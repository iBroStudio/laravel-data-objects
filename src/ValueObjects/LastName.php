<?php

namespace IBroStudio\DataObjects\ValueObjects;

use IBroStudio\DataObjects\Formatters\LastNameFormatter;

class LastName extends ValueObject
{
    public function __construct(mixed $value)
    {
        parent::__construct(
            LastNameFormatter::format($value)
        );
    }
}
