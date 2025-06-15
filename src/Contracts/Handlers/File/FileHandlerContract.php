<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Contracts\Handlers\File;

use IBroStudio\DataObjects\Enums\FileHandlerTypeEnum;
use IBroStudio\DataObjects\Handlers\File\Php\Finder;
use IBroStudio\DataObjects\ValueObjects\DataFile;

interface FileHandlerContract
{
    public array|string|null $statement { get; }

    public FileHandlerTypeEnum $fileType { get; }

    public Finder $finder { get; }

    public function parse(): void;

    public function properties(): ?PropertyHandlerContract;

    public function methods(): ?MethodHandlerContract;

    public function class(): ?ClassHandlerContract;

    public function namespace(): ?NamespaceHandlerContract;

    public function imports(): ?ImportHandlerContract;

    public function print(): string;

    public function save(): bool;

    public function addFromStub(DataFile $stub): bool;
}
