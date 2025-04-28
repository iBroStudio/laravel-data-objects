<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\ValueObjects;

use IBroStudio\DataObjects\Formatters\LastNameFormatter;

final class LastName extends ValueObject
{
    public function __construct(mixed $value)
    {
        parent::__construct(
            LastNameFormatter::format($value)
        );
    }
}
