<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\ValueObjects;

use IBroStudio\DataObjects\Formatters\NameFormatter;

final class CompanyName extends ValueObject
{
    public function __construct(mixed $value)
    {
        parent::__construct(
            NameFormatter::format($value)
        );
    }
}
