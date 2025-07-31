<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Rules;

use Closure;
use IBroStudio\DataObjects\Terminal\ValidateSshPrivateKey;
use Illuminate\Contracts\Validation\ValidationRule;

class SshPrivateKeyRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! new ValidateSshPrivateKey($value)()) {
            $fail('This is not a valid SSH private key.');
        }
    }
}
