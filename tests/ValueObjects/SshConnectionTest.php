<?php

declare(strict_types=1);

use IBroStudio\DataObjects\Dto\SshConfigDto;
use IBroStudio\DataObjects\ValueObjects\Authentication\SshAuthentication;
use IBroStudio\DataObjects\ValueObjects\Domain;
use IBroStudio\DataObjects\ValueObjects\IpAddress;
use IBroStudio\DataObjects\ValueObjects\SshConnection;
use IBroStudio\DataObjects\ValueObjects\SshKey;
use Spatie\Ssh\Ssh;

it('can instantiate SshConnection object value', function (IpAddress|Domain $host) {
    $connection = SshConnection::from(
        SshConfigDto::from([
            'host' => $host,
            'sshAuthentication' => SshAuthentication::from(
                username: fake()->userName,
                sshKey: SshKey::from(
                    reference: fake()->uuid,
                    privateKey: getFakeSshPrivateKey(),
                    passphrase: fake()->password,
                )
            ),
        ])
    );

    expect($connection)->toBeInstanceOf(SshConnection::class)
        ->and($connection->ssh)->toBeInstanceOf(Ssh::class);
})->with([
    'ip' => fn () => IpAddress::from(fake()->ipv4),
    'domain' => fn () => Domain::from('ibro.studio'),
]);
