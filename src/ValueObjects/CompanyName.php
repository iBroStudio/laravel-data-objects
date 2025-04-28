<?php

namespace IBroStudio\DataObjects\ValueObjects;

use IBroStudio\DataObjects\Formatters\NameFormatter;

class CompanyName extends ValueObject
{
    public function __construct(mixed $value)
    {
        parent::__construct(
            NameFormatter::format($value)
        );
    }
}
