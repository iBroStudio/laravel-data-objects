<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Rules;

use Closure;
use IBroStudio\DataObjects\ValueObjects\Domain;
use Illuminate\Contracts\Validation\ValidationRule;

class DomainRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_null($value) && is_null(Domain::fromOrNull($value))) {
            $fail(':attribute is not a valid value.');
        }
    }
}
