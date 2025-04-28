<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\ValueObjects;

use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

final class Boolean extends ValueObject
{
    public function __construct(mixed $value)
    {
        parent::__construct(
            ! is_bool($value) ? $this->handleNonBoolean($value) : $value
        );
    }

    public function toString(): string
    {
        return $this->value ? 'true' : 'false';
    }

    protected function handleNonBoolean(int|string $value): bool
    {
        $string = is_string($value) ? $value : (string) $value;

        return match (true) {
            Str::contains($string, ['1', 'true', 'on', 'yes'], ignoreCase: true) => true,
            Str::contains($string, ['0', 'false', 'off', 'no'], ignoreCase: true) => false,
            default => throw ValidationException::withMessages(['Invalid boolean.']),
        };
    }
}
