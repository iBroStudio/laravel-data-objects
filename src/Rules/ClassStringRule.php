<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Rules;

use Closure;
use IBroStudio\DataObjects\ValueObjects\ClassString;
use Illuminate\Contracts\Validation\ValidationRule;

class ClassStringRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_null($value)
            && (is_null($classString = ClassString::fromOrNull($value))
                || (! $classString->classExists() && ! $classString->interfaceExists()))) {
            $fail(':attribute is not a valid value.');
        }
    }
}
