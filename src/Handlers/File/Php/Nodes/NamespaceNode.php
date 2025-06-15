<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Handlers\File\Php\Nodes;

use IBroStudio\DataObjects\Contracts\Handlers\File\FileHandlerNodeContract;
use PhpParser\Node;

/**
 * @property Node\Stmt\Namespace_ $node
 */
class NamespaceNode extends NodeObject implements FileHandlerNodeContract
{
    public function addToStatement(NodeObject $node): bool
    {
        array_unshift($this->node->stmts, $node->node);

        return true;
    }
}
