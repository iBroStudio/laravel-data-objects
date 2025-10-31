<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\ValueObjects;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Number;
use Illuminate\Validation\ValidationException;

final class Percentage extends ValueObject
{
    private FloatValueObject $quotient;

    public function __construct(mixed $value)
    {
        parent::__construct($value);

        $this->quotient = FloatValueObject::from($value / 100);
    }

    /*
    public static function from(mixed ...$values): static
    {
        // dd($values);
        if (is_array($values[0])) {
            return new self($values[0][0] * 100);
        }

        // @phpstan-ignore-next-line
        return new self(...$values);
    }
    */

    public function getQuotient(): float
    {
        return $this->quotient->value;
    }

    public function format(): int|float
    {
        $value = $this->value * 100;

        if ($value - (int) $value > 0) {
            return (float) $value;
        }

        return (int) $value;
    }

    public function of(int|float $total): int|float
    {
        return $total * $this->quotient->value;
    }

    public function toString(): string
    {
        $value = $this->value;

        $precision = is_float($value) ? 1 : 0;

        return Number::percentage($value, precision: $precision, locale: session('lang_country', app()->getLocale()));
    }

    protected function validate(): void
    {
        parent::validate();

        $validator = Validator::make(
            ['value' => $this->value],
            ['value' => 'numeric:strict'],
        );

        if ($validator->fails()) {
            throw ValidationException::withMessages(['Value is not valid.']);
        }
    }
}
