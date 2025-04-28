<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\ValueObjects;

use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

final class Uuid extends ValueObject
{
    protected function validate(): void
    {
        parent::validate();

        if (! Str::of($this->value)->isUuid()) {
            throw ValidationException::withMessages(['UUID is not valid.']);
        }
    }
}
