<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\ValueObjects\Authentication;

use IBroStudio\DataObjects\ValueObjects\SshKey;

final class SshAuthentication extends AuthenticationAbstract
{
    public readonly SshKey $sshKey;

    public function __construct(
        public readonly string $username,
        SshKey|array $sshKey)
    {
        $this->sshKey = is_array($sshKey) ? SshKey::from(...$sshKey) : $sshKey;

        parent::__construct($this->username);
    }

    public function toArray(): array
    {
        return [
            'username' => $this->username,
            'sshKey' => $this->sshKey->toArray(),
        ];
    }

    public function toDecryptedArray(): array
    {
        return [
            'username' => $this->username,
            'sshKey' => $this->sshKey->toDecryptedArray(),
        ];
    }
}
