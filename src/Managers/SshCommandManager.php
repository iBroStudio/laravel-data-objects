<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Managers;

use IBroStudio\DataObjects\Testing\FakeSsh;
use PHPUnit\Framework\Assert;
use Spatie\Ssh\Ssh;

class SshCommandManager
{
    protected bool $faking = false;

    protected array $fakeResponses = [];

    protected array $executedCommands = [];

    public function create(string $user, string $host, int $port = 22): Ssh|FakeSsh
    {
        if ($this->faking) {
            return new FakeSsh($user, $host, $port, $this->fakeResponses, $this);
        }

        return Ssh::create($user, $host, $port);
    }

    public function fake(array $responses = []): void
    {
        $this->faking = true;
        $this->fakeResponses = $responses;
        $this->executedCommands = [];
    }

    public function stopFaking(): void
    {
        $this->faking = false;
        $this->fakeResponses = [];
        $this->executedCommands = [];
    }

    public function recordCommand(string $command): void
    {
        $this->executedCommands[] = $command;
    }

    public function assertExecuted(string $command): void
    {
        Assert::assertContains(
            $command,
            $this->executedCommands,
            "The SSH command [{$command}] was not executed."
        );
    }

    public function assertNotExecuted(string $command): void
    {
        Assert::assertNotContains(
            $command,
            $this->executedCommands,
            "The SSH command [{$command}] was executed but should not have been."
        );
    }

    public function getExecutedCommands(): array
    {
        return $this->executedCommands;
    }

    public function isFaking(): bool
    {
        return $this->faking;
    }
}
