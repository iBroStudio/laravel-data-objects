<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Terminal;

final class ValidateSshPrivateKey extends ValidateSshKey
{
    public function __invoke(): bool
    {
        return $this->isPrivateKey();
    }
}
