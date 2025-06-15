<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Handlers\File\Php\Nodes;

use PhpParser\Node;

/**
 * @property Node\Stmt\Use_ $node
 */
class ImportNode extends NodeObject
{
    public function name(): string
    {
        return $this->node->uses[0]->name->toString();
    }
}
