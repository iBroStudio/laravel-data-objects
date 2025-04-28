<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Contracts;

interface Formatter
{
    public static function format(string $value): string;
}
