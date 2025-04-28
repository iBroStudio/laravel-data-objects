<?php

namespace IBroStudio\DataObjects\Formatters;

use IBroStudio\DataObjects\Contracts\Formatter;
use Illuminate\Support\Str;

class NameFormatter implements Formatter
{
    public static function format(string $value): string
    {
        return Str::of($value)
            ->squish()
            ->title()
            ->value();
    }
}
