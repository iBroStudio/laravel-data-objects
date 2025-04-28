<?php

namespace IBroStudio\DataObjects\Rules;

use Closure;
use IBroStudio\DataObjects\Terminal\ValidateSshKey;
use Illuminate\Contracts\Validation\ValidationRule;

class IsSshKeyValidRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $validateSsh = new ValidateSshKey($value);

        if (! $validateSsh()) {
            $fail('The :attribute is not a valid SSH key.');
        }
    }
}
