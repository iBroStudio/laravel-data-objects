<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\ValueObjects;

use IBroStudio\DataObjects\Casts\EloquentValueObjectCast;
use IBroStudio\DataObjects\Exceptions\EmptyValueObjectException;
use Illuminate\Contracts\Database\Eloquent\Castable;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Contracts\Support\Arrayable;
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

    public static function from(mixed ...$values): static
    {
        // @phpstan-ignore-next-line
        return new static(...$values);
    }

    public static function fromOrNull(mixed ...$values): ?static
    {
        try {
            return static::from(...$values);
        } catch (Throwable) {
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
        return json_encode($this->toArray());
    }

    /** @return array<string, mixed>|Collection<string, mixed> */
    public function values(): array|Collection
    {
        return get_object_vars($this);
    }

    protected function validate(): void
    {
        if ($this->value === '') {
            throw EmptyValueObjectException::withMessages([class_basename(get_class($this)).' cannot be empty.']);
        }
    }
}
