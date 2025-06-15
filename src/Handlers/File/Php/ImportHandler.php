<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Handlers\File\Php;

use IBroStudio\DataObjects\Contracts\Handlers\File\ImportHandlerContract;
use IBroStudio\DataObjects\Handlers\File\Php\Collections\ImportsCollection;
use IBroStudio\DataObjects\Handlers\File\Php\Nodes\ImportNode;
use IBroStudio\DataObjects\Handlers\File\PhpFileHandler;

final class ImportHandler implements ImportHandlerContract
{
    public function __construct(public PhpFileHandler $handler) {}

    public function all(): ImportsCollection
    {
        return new ImportsCollection($this->handler->finder->imports());
    }

    public function add(ImportNode $node): bool
    {
        if (in_array($node->name(), $this->all()->keys()->toArray())) {
            return true;
        }

        return $this->handler->namespace()->node->addToStatement($node);
    }
}
