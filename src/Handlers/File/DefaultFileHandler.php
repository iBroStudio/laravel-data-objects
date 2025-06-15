<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Handlers\File;

use IBroStudio\DataObjects\Contracts\Handlers\File\ClassHandlerContract;
use IBroStudio\DataObjects\Contracts\Handlers\File\FileHandlerContract;
use IBroStudio\DataObjects\Enums\FileHandlerTypeEnum;
use IBroStudio\DataObjects\Handlers\File\Php\Finder;
use IBroStudio\DataObjects\Handlers\File\Php\ImportHandler;
use IBroStudio\DataObjects\Handlers\File\Php\MethodHandler;
use IBroStudio\DataObjects\Handlers\File\Php\NamespaceHandler;
use IBroStudio\DataObjects\Handlers\File\Php\PropertyHandler;
use IBroStudio\DataObjects\ValueObjects\DataFile;

final class DefaultFileHandler implements FileHandlerContract
{
    public array|string|null $statement;

    public FileHandlerTypeEnum $fileType;

    public Finder $finder;

    public function __construct(private readonly DataFile $dataFile)
    {
        $this->parse();
    }

    public function parse(): void
    {
        $this->statement = $this->dataFile->content();
    }

    public function properties(): ?PropertyHandler
    {
        return null;
    }

    public function methods(): ?MethodHandler
    {
        return null;
    }

    public function namespace(): ?NamespaceHandler
    {
        return null;
    }

    public function class(): ?ClassHandlerContract
    {
        return null;
    }

    public function imports(): ?ImportHandler
    {
        return null;
    }

    public function print(): string
    {
        return (string) $this->statement;
    }

    public function save(): bool
    {
        return $this->dataFile->disk->filesystem->put($this->dataFile->value, $this->print());
    }

    public function addFromStub(DataFile $stub): bool
    {
        return true;
    }
}
