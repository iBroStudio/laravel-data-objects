<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Concerns;

use IBroStudio\DataObjects\Contracts\Handlers\File\ClassHandlerContract;
use IBroStudio\DataObjects\Contracts\Handlers\File\FileHandlerContract;
use IBroStudio\DataObjects\Contracts\Handlers\File\ImportHandlerContract;
use IBroStudio\DataObjects\Contracts\Handlers\File\MethodHandlerContract;
use IBroStudio\DataObjects\Contracts\Handlers\File\NamespaceHandlerContract;
use IBroStudio\DataObjects\Contracts\Handlers\File\PropertyHandlerContract;
use IBroStudio\DataObjects\Facades\FileHandler;

trait HasFileHandler
{
    public FileHandlerContract $handler;

    public function properties(): ?PropertyHandlerContract
    {
        return $this->handler->properties();
    }

    public function methods(): ?MethodHandlerContract
    {
        return $this->handler->methods();
    }

    public function namespace(): ?NamespaceHandlerContract
    {
        return $this->handler->namespace();
    }

    public function imports(): ?ImportHandlerContract
    {
        return $this->handler->imports();
    }

    public function class(): ?ClassHandlerContract
    {
        return $this->handler->class();
    }

    public function save(): bool
    {
        return $this->handler->save();
    }

    private function loadFileHandler(): void
    {
        $this->handler = FileHandler::handle($this);
    }
}
