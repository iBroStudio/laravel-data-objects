<?php

namespace IBroStudio\DataObjects\ValueObjects;

use IBroStudio\DataObjects\Rules\IsEncryptedRule;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

final class EncryptableText extends ValueObject
{
    public static function from(mixed ...$values): static
    {
        $value = current($values);

        return new self(
            self::isEncrypted($value)
                ? $value
                : Crypt::encryptString($value)
        );
    }

    public function decrypt(): string
    {
        return Crypt::decryptString($this->value);
    }

    protected function validate(): void
    {
        parent::validate();

        if (! self::isEncrypted($this->value)) {
            throw ValidationException::withMessages(['Value must be encrypted.']);
        }
    }

    private static function isEncrypted(string $value): bool
    {
        $validator = Validator::make(['value' => $value], [
            'value' => new IsEncryptedRule,
        ]);

        return ! $validator->fails();
    }
}
