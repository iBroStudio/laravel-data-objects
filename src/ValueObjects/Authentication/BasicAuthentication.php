<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\ValueObjects\Authentication;

use IBroStudio\DataObjects\Exceptions\EmptyValueObjectException;
use IBroStudio\DataObjects\ValueObjects\EncryptableText;
use Illuminate\Support\Str;

final class BasicAuthentication extends AuthenticationAbstract
{
    public readonly EncryptableText $password;

    public function __construct(public readonly string $username, EncryptableText|string $password)
    {
        try {
            $this->password = $password instanceof EncryptableText
                ? $password
                : EncryptableText::from($password);

        } catch (EmptyValueObjectException $e) {
            throw EmptyValueObjectException::withMessages(['Password cannot be empty.']);
        }

        parent::__construct(
            Str::of($this->username)
                ->append(':')
                ->append($this->password->value)
                ->value()
        );
    }

    public function toArray(): array
    {
        return [
            'username' => $this->username,
            'password' => $this->password->value,
        ];
    }

    public function toDecryptedArray(): array
    {
        return [
            'username' => $this->username,
            'password' => $this->password->decrypt(),
        ];
    }

    protected function validate(): void
    {
        if ($this->username === '') {
            throw EmptyValueObjectException::withMessages(['Username cannot be empty.']);
        }
    }
}
