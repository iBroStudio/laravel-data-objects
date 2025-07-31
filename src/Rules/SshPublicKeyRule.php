<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Rules;

use Closure;
use IBroStudio\DataObjects\Terminal\ValidateSshPublicKey;
use Illuminate\Contracts\Validation\ValidationRule;

class SshPublicKeyRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! new ValidateSshPublicKey($value)()) {
            $fail('This is not a valid SSH public key.');
        }
    }
}
