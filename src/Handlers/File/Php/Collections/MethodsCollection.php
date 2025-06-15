<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Handlers\File\Php\Collections;

use IBroStudio\DataObjects\Handlers\File\Php\Nodes\MethodNode;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use PhpParser\Node;

class MethodsCollection extends Collection
{
    public function __construct($items = [])
    {
        parent::__construct(
            Arr::mapWithKeys($items, fn (Node\Stmt\ClassMethod $item) => [$item->name->toString() => new MethodNode($item)])
        );
    }

    public function keys(): Collection|self
    {
        // @phpstan-ignore-next-line
        return new Collection(array_keys($this->items));
    }
}
