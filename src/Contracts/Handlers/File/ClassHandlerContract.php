<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Contracts\Handlers\File;

use IBroStudio\DataObjects\Handlers\File\Php\Nodes\ClassNode;

interface ClassHandlerContract
{
    public ClassNode $node { get; }
}
