<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Rules;

use Closure;
use IBroStudio\DataObjects\ValueObjects\VatNumber;
use Illuminate\Contracts\Validation\ValidationRule;

class VatNumberRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_null($value) && is_null(VatNumber::fromOrNull($value))) {
            $fail(':attribute is not a valid value.');
        }
    }
}
