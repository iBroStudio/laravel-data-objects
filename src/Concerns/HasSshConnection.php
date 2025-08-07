<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Concerns;

use IBroStudio\DataObjects\Dto\SshConfigDto;
use IBroStudio\DataObjects\ValueObjects\SshConnection;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasSshConnection
{
    protected SshConnection|bool $sshConnected = false;

    public function __destruct()
    {
        if (is_a($this->sshConnected, SshConnection::class)) {
            $this->sshConnected->cleanup();
        }
    }

    abstract public function sshConfig(): SshConfigDto;

    protected function sshConnection(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (! $this->sshConnected) {
                    $this->sshConnected = SshConnection::from($this->sshConfig());
                }

                return $this->sshConnected;
            },
        );
    }
}
