<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Testing;

class FakeSshProcess
{
    protected string $command;

    protected string $output;

    protected int $exitCode;

    public function __construct(string $command, string $output, int $exitCode = 0)
    {
        $this->command = $command;
        $this->output = $output;
        $this->exitCode = $exitCode;
    }

    public function getOutput(): string
    {
        return $this->output;
    }

    public function getErrorOutput(): string
    {
        return '';
    }

    public function getExitCode(): ?int
    {
        return $this->exitCode;
    }

    public function isSuccessful(): bool
    {
        return $this->exitCode === 0;
    }

    public function getCommandLine(): string
    {
        return $this->command;
    }

    public function run(): int
    {
        return $this->exitCode;
    }

    public function start(): void
    {
        // Fake process is already "started"
    }

    public function wait(): int
    {
        return $this->exitCode;
    }

    public function isRunning(): bool
    {
        return false;
    }

    public function isStarted(): bool
    {
        return true;
    }

    public function isTerminated(): bool
    {
        return true;
    }

    public function getStatus(): string
    {
        return 'terminated';
    }

    public function stop(): int
    {
        return $this->exitCode;
    }

    public function getPid(): ?int
    {
        return null;
    }

    public function getTimeout(): ?float
    {
        return null;
    }

    public function getIdleTimeout(): ?float
    {
        return null;
    }

    public function setTimeout(?float $timeout): static
    {
        return $this;
    }

    public function setIdleTimeout(?float $timeout): static
    {
        return $this;
    }

    public function getWorkingDirectory(): ?string
    {
        return null;
    }

    public function setWorkingDirectory(string $cwd): static
    {
        return $this;
    }

    public function getEnv(): array
    {
        return [];
    }

    public function setEnv(array $env): static
    {
        return $this;
    }

    public function getInput()
    {
        return null;
    }

    public function setInput($input): static
    {
        return $this;
    }
}
