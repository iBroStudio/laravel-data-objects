<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Handlers\File\Php\Nodes;

use IBroStudio\DataObjects\Contracts\Handlers\File\FileHandlerNodeContract;
use PhpParser\Node;

/**
 * @property Node\Stmt\Class_ $node
 */
class ClassNode extends NodeObject implements FileHandlerNodeContract
{
    public function addToStatement(NodeObject $node): bool
    {
        // @phpstan-ignore-next-line
        $this->node->stmts[] = $node->node;

        return true;
    }

    public function removeFromStatement(NodeObject $node): bool
    {
        $state = false;

        collect($this->node->stmts)
            ->each(function (mixed $item, int $key) use ($node, &$state) {

                if ($item instanceof Node\Stmt\ClassMethod && $item->name->toString() === $node->name()) {

                    data_forget($this->node->stmts, $key);

                    $state = true;

                    return false;
                }

                return true;
            });

        return $state;
    }
}
