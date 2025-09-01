<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Testing;

use Closure;
use IBroStudio\DataObjects\Managers\SshCommandManager;

class FakeSsh
{
    protected string $user;

    protected string $host;

    protected int $port;

    protected array $fakeResponses;

    protected SshCommandManager $manager;

    protected ?string $privateKeyPath = null;

    protected ?string $password = null;

    public function __construct(string $user, string $host, int $port, array $fakeResponses, SshCommandManager $manager)
    {
        $this->user = $user;
        $this->host = $host;
        $this->port = $port;
        $this->fakeResponses = $fakeResponses;
        $this->manager = $manager;
    }

    public function usePrivateKey(string $pathToPrivateKey): self
    {
        $this->privateKeyPath = $pathToPrivateKey;

        return $this;
    }

    public function useJumpHost(string $jumpHost): self
    {
        return $this;
    }

    public function usePort(int $port): self
    {
        $this->port = $port;

        return $this;
    }

    public function usePassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function useMultiplexing(string $controlPath, string $controlPersist): self
    {
        return $this;
    }

    public function configureProcess(Closure $processConfigurationClosure): self
    {
        return $this;
    }

    public function onOutput(Closure $onOutput): self
    {
        return $this;
    }

    public function enableStrictHostKeyChecking(): self
    {
        return $this;
    }

    public function setTimeout(int $timeout): self
    {
        return $this;
    }

    public function disableStrictHostKeyChecking(): self
    {
        return $this;
    }

    public function enableQuietMode(): self
    {
        return $this;
    }

    public function disableQuietMode(): self
    {
        return $this;
    }

    public function disablePasswordAuthentication(): self
    {
        return $this;
    }

    public function enablePasswordAuthentication(): self
    {
        return $this;
    }

    public function addExtraOption(string $option): self
    {
        return $this;
    }

    public function removeBash(): self
    {
        return $this;
    }

    public function execute($command): FakeSshProcess
    {
        $commandString = is_array($command) ? implode(' && ', $command) : $command;

        $this->manager->recordCommand($commandString);

        $output = $this->fakeResponses[$commandString] ?? '';

        return new FakeSshProcess($commandString, $output);
    }

    public function executeAsync($command): FakeSshProcess
    {
        return $this->execute($command);
    }

    public function download(string $sourcePath, string $destinationPath): FakeSshProcess
    {
        $command = "scp {$sourcePath} {$destinationPath}";
        $this->manager->recordCommand($command);

        $output = $this->fakeResponses[$command] ?? '';

        return new FakeSshProcess($command, $output);
    }

    public function upload(string $sourcePath, string $destinationPath): FakeSshProcess
    {
        $command = "scp {$sourcePath} {$destinationPath}";
        $this->manager->recordCommand($command);

        $output = $this->fakeResponses[$command] ?? '';

        return new FakeSshProcess($command, $output);
    }
}
