<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\ValueObjects;

use Brick\Math\BigDecimal;
use IBroStudio\DataObjects\Formatters\LastNameFormatter;
use IBroStudio\DataObjects\Formatters\NameFormatter;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Number;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

final class Percentage extends FloatValueObject
{
    public function __construct(mixed $value)
    {
        parent::__construct($value / 100);
    }

    public static function from(mixed ...$values): static
    {
        //dd($values);
        if (is_array($values[0])) {
            return new self($values[0][0] * 100);
        }

        // @phpstan-ignore-next-line
        return new self(...$values);
    }

    public function format(): int|float
    {
        $value = $this->value * 100;

        if ($value - (int) $value > 0) {
            return (float) $value;
        }

        return (int) $value;
    }

    public function toString(): string
    {
        $value = $this->format();

        $precision = is_float($value) ? 1 : 0;

        return Number::percentage($value, precision: $precision, locale: session('lang_country', app()->getLocale()));
    }
}
