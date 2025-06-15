<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Contracts\Handlers\File;

use IBroStudio\DataObjects\Handlers\File\Php\Nodes\NamespaceNode;

interface NamespaceHandlerContract
{
    public NamespaceNode $node { get; }
}
