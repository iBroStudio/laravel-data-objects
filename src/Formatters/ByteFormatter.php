<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Formatters;

use IBroStudio\DataObjects\Contracts\Formatter;
use Illuminate\Support\Str;

final class ByteFormatter implements Formatter
{
    public static function format(string $value): string
    {
        $unit = Str::substr($value, -2);

        return Str::of($value)
            ->chopEnd($unit)
            ->rtrim('0')
            ->chopEnd('.')
            ->append($unit)
            ->value();
    }
}
