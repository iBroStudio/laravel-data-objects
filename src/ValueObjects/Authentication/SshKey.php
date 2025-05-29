<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\ValueObjects\Authentication;

use Closure;
use IBroStudio\DataObjects\Exceptions\EmptyValueObjectException;
use IBroStudio\DataObjects\Terminal\ValidateSshPrivateKey;
use IBroStudio\DataObjects\Terminal\ValidateSshPublicKey;
use IBroStudio\DataObjects\ValueObjects\EncryptableText;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

final class SshKey extends AuthenticationAbstract
{
    public readonly ?EncryptableText $publicKey;

    public readonly ?EncryptableText $privateKey;

    public readonly ?EncryptableText $passphrase;

    public function __construct(
        public readonly string $username,
        EncryptableText|string|null $publicKey = null,
        EncryptableText|string|null $privateKey = null,
        EncryptableText|string|null $passphrase = null)
    {
        if (is_null($publicKey) && is_null($privateKey)) {
            throw EmptyValueObjectException::withMessages(['Provide a public and/or a private SSH key.']);
        }

        $this->publicKey = $publicKey ?
            $publicKey instanceof EncryptableText ? $publicKey : EncryptableText::from($publicKey)
            : null;

        $this->privateKey = $privateKey ?
            $privateKey instanceof EncryptableText ? $privateKey : EncryptableText::from($privateKey)
            : null;

        $this->passphrase = $passphrase ?
            $passphrase instanceof EncryptableText ? $passphrase : EncryptableText::from($passphrase)
            : null;

        parent::__construct($this->username);
    }

    public function toArray(): array
    {
        return [
            'username' => $this->username,
            'publicKey' => $this->publicKey?->value,
            'privateKey' => $this->privateKey?->value,
            'passphrase' => $this->passphrase?->value,
        ];
    }

    public function toDecryptedArray(): array
    {
        return [
            'username' => $this->username,
            'publicKey' => $this->publicKey?->decrypt(),
            'privateKey' => $this->privateKey?->decrypt(),
            'passphrase' => $this->passphrase?->decrypt(),
        ];
    }

    protected function validate(): void
    {
        parent::validate();

        $validator = Validator::make(
            [
                'publicKey' => $this->publicKey?->decrypt(),
                'privateKey' => $this->privateKey?->decrypt(),
            ],
            [
                'publicKey' => [
                    'nullable',
                    function (string $attribute, mixed $value, Closure $fail) {
                        if (! new ValidateSshPublicKey($value)()) {
                            $fail('The :attribute is not a valid SSH key.');
                        }
                    },
                ],
                'privateKey' => [
                    'nullable',
                    function (string $attribute, mixed $value, Closure $fail) {
                        if (! new ValidateSshPrivateKey($value)()) {
                            $fail('The :attribute is not a valid SSH key.');
                        }
                    },
                ],
            ],
        );

        if ($validator->stopOnFirstFailure()->fails()) {
            throw ValidationException::withMessages($validator->errors()->toArray());
        }
    }
}
