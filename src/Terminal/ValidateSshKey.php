<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Terminal;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Str;

abstract class ValidateSshKey
{
    private string $keyPath;

    public function __construct(
        private readonly string $content
    ) {
        if (! File::isDirectory($path = storage_path('ssh'))) {
            File::makeDirectory($path);
        }

        $this->keyPath = storage_path('ssh/'.Str::uuid());

        File::put($this->keyPath, $this->content);

        File::chmod($this->keyPath, 0600);
    }

    protected function isPrivateKey(): bool
    {
        $process = Process::run('ssh-keygen -yf '.$this->keyPath);

        return tap(
            $this->isKey()
                && $process->successful()
                && ! empty($process->output()),
            fn () => File::delete($this->keyPath)
        );
    }

    protected function isPublicKey(): bool
    {
        return tap(
            $this->isKey()
            && ! $this->isPrivateKey(),
            fn () => File::delete($this->keyPath)
        );
    }

    private function isKey(): bool
    {
        $process = Process::run('ssh-keygen -lf '.$this->keyPath);

        return $process->successful() && ! empty($process->output());
    }
}
