<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Rules;

use Closure;
use IBroStudio\DataObjects\Terminal\ValidateSshKey;
use Illuminate\Contracts\Validation\ValidationRule;

final class IsSshKeyValidRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $validateSsh = new ValidateSshKey($value);

        if (! $validateSsh()) {
            $fail('The :attribute is not a valid SSH key.');
        }
    }
}
