<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\ValueObjects;

use IBroStudio\DataObjects\Casts\EloquentValueObjectCast;
use IBroStudio\DataObjects\Exceptions\EmptyValueObjectException;
use Illuminate\Contracts\Database\Eloquent\Castable;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Throwable;

/**
 * @implements Arrayable<string, string>
 */
abstract class ValueObject implements Arrayable, Castable
{
    public readonly mixed $value;

    public function __construct(mixed $value)
    {
        $this->value = $value;

        $this->validate();
    }

    public static function make(): static
    {
        // @phpstan-ignore-next-line
        return new static();
    }

    public static function from(mixed ...$values): static
    {
        // @phpstan-ignore-next-line
        return new static(...$values);
    }

    public static function fromOrNull(mixed ...$values): ?static
    {
        try {
            return static::from(...$values);
        } catch (Throwable $e) {
            return null;
        }
    }

    /**
     * @param  array<string, mixed>  $arguments
     * @return EloquentValueObjectCast
     */
    public static function castUsing(array $arguments): CastsAttributes
    {
        return new EloquentValueObjectCast(static::class, $arguments);
    }

    public function toArray(): array
    {
        return (array) $this->value;
    }

    public function toString(): string
    {
        return (string) $this->value;
    }

    public function toJson(): false|string
    {
        if (count($array = $this->toArray()) < 2 && ! is_object($this->value)) {
            return $this->toString();
        }

        return json_encode($array);
    }

    /** @return array<string, mixed>|Collection<string, mixed> */
    public function values(): array|Collection
    {
        return get_object_vars($this);

        return Arr::map(get_object_vars($this), fn (mixed $value) => is_a($value, ValueObject::class) ? get_object_vars($value) : $value);

    }

    protected function validate(): void
    {
        if ($this->value === '') {
            throw EmptyValueObjectException::withMessages([class_basename(get_class($this)).' cannot be empty.']);
        }
    }
}
