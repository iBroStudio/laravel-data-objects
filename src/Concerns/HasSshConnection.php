<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Concerns;

use IBroStudio\DataObjects\Dto\SshConfigDto;
use IBroStudio\DataObjects\ValueObjects\SshConnection;

trait HasSshConnection
{
    abstract public function sshConfig(): SshConfigDto;

    public function connection(): SshConnection
    {
        return SshConnection::from($this->sshConfig());
    }
}
