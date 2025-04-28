<?php

namespace IBroStudio\DataObjects\ValueObjects;

use Brick\Math\BigDecimal;
use Brick\Math\RoundingMode;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

/**
 * @method string plus(float|int|string|BigDecimal $that)
 * @method string minus(float|int|string|BigDecimal $that)
 * @method string multipliedBy(float|int|string|BigDecimal $that)
 * @method string dividedBy(float|int|string|BigDecimal $that, ?int $scale = null, RoundingMode $roundingMode = RoundingMode::UNNECESSARY)
 */
class FloatValueObject extends ValueObject
{
    protected BigDecimal $bigDecimal;

    public function __construct(mixed $value)
    {
        try {
            $this->bigDecimal = BigDecimal::of(Str::of($value)->toString());
        } catch (\Exception $e) {
            throw ValidationException::withMessages([$e->getMessage()]);
        }

        parent::__construct(
            $this->bigDecimal->toFloat()
        );
    }

    public function __call(string $method, mixed $parameters)
    {
        return $this->bigDecimal->{$method}(...$parameters)->toFloat();
    }
}
