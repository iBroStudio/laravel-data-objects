<?php

namespace IBroStudio\DataObjects\Terminal;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Str;

class ValidateSshKey
{
    private string $keyPath;

    public function __construct(
        private readonly string $content
    ) {

        if (! File::isDirectory($path = storage_path('ssh'))) {
            File::makeDirectory($path);
        }

        $this->keyPath = storage_path('ssh/'.Str::uuid().'.pub');

        file_put_contents($this->keyPath, $this->content);
    }

    public function __invoke(): bool
    {
        $process = Process::run('ssh-keygen -lf '.$this->keyPath);

        Process::run('rm '.$this->keyPath);

        return $process->successful();
    }
}
