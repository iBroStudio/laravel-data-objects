<?php

namespace IBroStudio\DataObjects\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class EloquentValueObjectCast implements CastsAttributes
{
    public function __construct(
        /** @var class-string<\IBroStudio\DataObjects\ValueObjects\ValueObject> $valueObjectClass */
        protected string $valueObjectClass,
        protected array $arguments,
    ) {}

    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        if (is_null($value)) {
            return null;
        }

        return $this->valueObjectClass::from(...json_decode($value, true));
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        if (! is_null($value)) {

            if (! $value instanceof $this->valueObjectClass) {
                $value = is_array($value)
                    ? $this->valueObjectClass::from(...$value)
                    : $this->valueObjectClass::from($value);
            }

            return $value->toJson();
        }

        return null;
    }
}
