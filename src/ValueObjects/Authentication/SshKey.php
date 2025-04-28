<?php

namespace IBroStudio\DataObjects\ValueObjects\Authentication;

use IBroStudio\DataObjects\Exceptions\EmptyValueObjectException;
use IBroStudio\DataObjects\Rules\IsSshKeyValidRule;
use IBroStudio\DataObjects\ValueObjects\EncryptableText;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class SshKey extends Authentication
{
    public readonly EncryptableText $public;

    public readonly ?EncryptableText $passphrase;

    public function __construct(
        public readonly string $user,
        EncryptableText|string $public,
        EncryptableText|string|null $passphrase = null)
    {
        try {
            $this->public = $public instanceof EncryptableText
                ? $public
                : EncryptableText::from($public);

        } catch (EmptyValueObjectException $e) {
            throw EmptyValueObjectException::withMessages(['Private key cannot be empty.']);
        }

        if ($passphrase) {
            $this->passphrase = $passphrase instanceof EncryptableText
                ? $passphrase
                : EncryptableText::from($passphrase);
        } else {
            $this->passphrase = null;
        }

        parent::__construct($this->user);
    }

    protected function validate(): void
    {
        parent::validate();

        $validator = Validator::make(
            ['ssh_key' => $this->public->decrypt()],
            ['ssh_key' => new IsSshKeyValidRule],
        );

        if ($validator->fails()) {
            throw ValidationException::withMessages(['Ssh key is not valid.']);
        }
    }

    public function toArray(): array
    {
        return [
            'user' => $this->user,
            'public' => $this->public->value,
            'passphrase' => $this->passphrase?->value,
        ];
    }
}
