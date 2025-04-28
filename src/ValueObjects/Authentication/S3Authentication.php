<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\ValueObjects\Authentication;

use IBroStudio\DataObjects\Exceptions\EmptyValueObjectException;
use IBroStudio\DataObjects\ValueObjects\EncryptableText;
use Illuminate\Support\Str;

final class S3Authentication extends Authentication
{
    public readonly EncryptableText $secret;

    public function __construct(public readonly string $key, EncryptableText|string $secret)
    {
        try {
            $this->secret = $secret instanceof EncryptableText
                ? $secret
                : EncryptableText::from($secret);

        } catch (EmptyValueObjectException $e) {
            throw EmptyValueObjectException::withMessages(['Secret cannot be empty.']);
        }

        parent::__construct(
            Str::of($this->key)
                ->append(':')
                ->append($this->secret->value)
                ->value()
        );
    }

    public function toArray(): array
    {
        return [
            'key' => $this->key,
            'secret' => $this->secret->value,
        ];
    }

    protected function validate(): void
    {
        if ($this->key === '') {
            throw EmptyValueObjectException::withMessages(['Key cannot be empty.']);
        }
    }
}
