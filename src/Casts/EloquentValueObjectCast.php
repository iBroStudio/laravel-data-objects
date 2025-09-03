<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

final class EloquentValueObjectCast implements CastsAttributes
{
    public function __construct(
        /** @var class-string<\IBroStudio\DataObjects\ValueObjects\ValueObject> $valueObjectClass */
        private string $valueObjectClass,
        private array $arguments,
    ) {}

    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        if (is_null($value)) {
            return null;
        }

        if (is_null($decoded = json_decode((string) $value, true)) || ! is_array($decoded)) {
            return $this->valueObjectClass::from($value);
        }

        return $this->valueObjectClass::from(...$decoded);
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        if (! is_null($value)) {

            if (! $value instanceof $this->valueObjectClass) {
                $value = is_array($value)
                    ? $this->valueObjectClass::from(...$value)
                    : $this->valueObjectClass::from($value);
            }

            return $value->toDatabase();
        }

        return null;
    }
}
