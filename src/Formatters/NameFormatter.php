<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Formatters;

use IBroStudio\DataObjects\Contracts\Formatter;
use Illuminate\Support\Str;

final class NameFormatter implements Formatter
{
    public static function format(string $value): string
    {
        return Str::of($value)
            ->squish()
            ->title()
            ->value();
    }
}
