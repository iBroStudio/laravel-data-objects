<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Rules;

use Closure;
use IBroStudio\DataObjects\ValueObjects\Timecode;
use Illuminate\Contracts\Validation\ValidationRule;

class TimecodeRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_null($value) && is_null(Timecode::fromOrNull($value))) {
            $fail(':attribute is not a valid value.');
        }
    }
}
