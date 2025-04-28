<?php

namespace IBroStudio\DataObjects\ValueObjects;

use Brick\Math\BigInteger;
use Brick\Math\RoundingMode;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

/**
 * @method string plus(float|int|string|BigInteger $that)
 * @method string minus(float|int|string|BigInteger $that)
 * @method string multipliedBy(float|int|string|BigInteger $that)
 * @method string dividedBy(float|int|string|BigInteger $that, RoundingMode $roundingMode = RoundingMode::UNNECESSARY)
 */
class IntegerValueObject extends ValueObject
{
    protected BigInteger $bigInteger;

    public function __construct(mixed $value)
    {
        try {
            $this->bigInteger = BigInteger::of(Str::of($value)->toString());
        } catch (\Exception $e) {
            throw ValidationException::withMessages([$e->getMessage()]);
        }

        parent::__construct(
            $this->bigInteger->toInt()
        );
    }

    public function __call(string $method, mixed $parameters)
    {
        return $this->bigInteger->{$method}(...$parameters)->toInt();
    }
}
