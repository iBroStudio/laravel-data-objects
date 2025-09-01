<?php

declare(strict_types=1);

use IBroStudio\DataObjects\Dto\SshConfigDto;
use IBroStudio\DataObjects\Facades\SshCommand;
use IBroStudio\DataObjects\ValueObjects\Authentication\SshAuthentication;
use IBroStudio\DataObjects\ValueObjects\Domain;
use IBroStudio\DataObjects\ValueObjects\IpAddress;
use IBroStudio\DataObjects\ValueObjects\SshConnection;
use IBroStudio\DataObjects\ValueObjects\SshKey;

beforeEach(function () {
    SshCommand::fake();
});

it('can fake SSH command execution', function () {
    SshCommand::fake([
        'ls -la' => "total 10\ndrwxr-xr-x 3 user user 4096 Jan 1 12:00 .\ndrwxr-xr-x 3 user user 4096 Jan 1 12:00 ..",
        'whoami' => 'testuser',
    ]);

    $ssh = SshCommand::create('testuser', 'example.com', 22);

    $result = $ssh->execute('ls -la');
    expect($result->getOutput())->toBe("total 10\ndrwxr-xr-x 3 user user 4096 Jan 1 12:00 .\ndrwxr-xr-x 3 user user 4096 Jan 1 12:00 ..");
    expect($result->isSuccessful())->toBeTrue();

    $result2 = $ssh->execute('whoami');
    expect($result2->getOutput())->toBe('testuser');
    expect($result2->isSuccessful())->toBeTrue();

    SshCommand::assertExecuted('ls -la');
    SshCommand::assertExecuted('whoami');
    SshCommand::assertNotExecuted('rm -rf /');

    $executedCommands = SshCommand::getExecutedCommands();
    expect($executedCommands)->toHaveCount(2)
        ->and($executedCommands)->toContain('ls -la')
        ->and($executedCommands)->toContain('whoami');
});

it('can fake SSH commands with SshConnection', function (IpAddress|Domain $host) {
    SshCommand::fake([
        'uptime' => 'up 5 days, 12:34',
        'df -h' => '/dev/sda1 50G 25G 23G 53% /',
    ]);

    $connection = SshConnection::from(
        SshConfigDto::from([
            'host' => $host,
            'sshAuthentication' => SshAuthentication::from(
                username: 'testuser',
                sshKey: SshKey::from(
                    reference: fake()->uuid,
                    privateKey: getFakeSshPrivateKey(),
                    passphrase: fake()->password,
                )
            ),
        ])
    );

    $uptimeResult = $connection->ssh->execute('uptime');
    expect($uptimeResult->getOutput())->toBe('up 5 days, 12:34');

    $diskResult = $connection->ssh->execute('df -h');
    expect($diskResult->getOutput())->toBe('/dev/sda1 50G 25G 23G 53% /');

    SshCommand::assertExecuted('uptime');
    SshCommand::assertExecuted('df -h');

    $connection->cleanup();
})->with([
    'ip' => fn () => IpAddress::from('192.168.1.100'),
    'domain' => fn () => Domain::from('test.example.com'),
]);

it('returns empty output for unmocked commands', function () {
    SshCommand::fake([
        'echo "hello"' => 'hello',
    ]);

    $ssh = SshCommand::create('user', 'host');

    $result = $ssh->execute('unmocked-command');
    expect($result->getOutput())->toBe('');
    expect($result->isSuccessful())->toBeTrue();

    SshCommand::assertExecuted('unmocked-command');
});

it('can fake array commands', function () {
    SshCommand::fake([
        'cd /tmp && ls -la && pwd' => '/tmp content',
    ]);

    $ssh = SshCommand::create('user', 'host');

    $result = $ssh->execute(['cd /tmp', 'ls -la', 'pwd']);
    expect($result->getOutput())->toBe('/tmp content');

    SshCommand::assertExecuted('cd /tmp && ls -la && pwd');
});
