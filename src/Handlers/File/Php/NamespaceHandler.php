<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Handlers\File\Php;

use IBroStudio\DataObjects\Contracts\Handlers\File\NamespaceHandlerContract;
use IBroStudio\DataObjects\Exceptions\FileHandlerNamespaceNotFoundException;
use IBroStudio\DataObjects\Handlers\File\Php\Nodes\NamespaceNode;
use IBroStudio\DataObjects\Handlers\File\PhpFileHandler;

final class NamespaceHandler implements NamespaceHandlerContract
{
    public NamespaceNode $node;

    /**
     * @throws FileHandlerNamespaceNotFoundException
     */
    public function __construct(public PhpFileHandler $handler)
    {
        $this->node = new NamespaceNode($this->handler->finder->namespace());
    }
}
