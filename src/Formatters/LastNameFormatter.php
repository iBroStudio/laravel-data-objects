<?php

namespace IBroStudio\DataObjects\Formatters;

use IBroStudio\DataObjects\Contracts\Formatter;
use Illuminate\Support\Str;

class LastNameFormatter implements Formatter
{
    public static function format(string $value): string
    {
        return Str::of($value)
            ->squish()
            ->upper()
            ->value();
    }
}
