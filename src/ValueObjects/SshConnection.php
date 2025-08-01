<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\ValueObjects;

use IBroStudio\DataObjects\Dto\SshConfigDto;
use Illuminate\Support\Facades\File;
use Spatie\Ssh\Ssh;

final class SshConnection extends ValueObject
{
    public readonly Ssh $ssh;

    private TempFolder $tempFolder;

    public function __construct(public SshConfigDto $config)
    {
        $this->tempFolder = TempFolder::make();

        $this->ssh = Ssh::create(
            $this->config->sshAuthentication->username,
            $this->config->host->value,
            $this->config->port
        )
            ->disableStrictHostKeyChecking();

        if (! is_null($this->config->sshAuthentication->sshKey->privateKey)) {
            $this->addPrivateKey();
        }

        if (! is_null($this->config->sshAuthentication->sshKey->passphrase)) {
            $this->addPassphrase();
        }

        parent::__construct($this->config->host);
    }

    private function addPrivateKey(): void
    {
        $privateKeyPath = $this->tempFolder->path(uniqid().'.private');

        File::put($privateKeyPath, $this->config->sshAuthentication->sshKey->privateKey->decrypt());

        $this->ssh->usePrivateKey($privateKeyPath);
    }

    private function addPassphrase(): void
    {
        $this->ssh->usePassword($this->config->sshAuthentication->sshKey->passphrase->decrypt());
    }
}
