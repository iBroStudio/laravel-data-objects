<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Handlers\File\Php\Collections;

use IBroStudio\DataObjects\Contracts\Handlers\File\FileHandlerNodeContract;
use IBroStudio\DataObjects\Handlers\File\Php\Nodes\NodeObject;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use PhpParser\Node;

class PropertiesCollection extends Collection
{
    public function __construct($items = [])
    {
        $items = match (true) {

            $items instanceof Node\Expr\Array_ => Arr::mapWithKeys($items->items,
                fn (Node\ArrayItem $item, int $key) => [$item->key->value ?? $key => new NodeObject($item->value)]
            ),

            current($items) instanceof Node\Stmt\Property => Arr::mapWithKeys($items,
                fn (Node\Stmt\Property $item) => [$item->props[0]->name->toString() => new NodeObject($item)]
            ),

            default => $items,
        };

        parent::__construct($items);
    }

    public function values(): Collection|self
    {
        return $this->map(function (FileHandlerNodeContract $node) {
            return $node->value();
        });
    }

    public function keys(): Collection|self
    {
        // @phpstan-ignore-next-line
        return new Collection(array_keys($this->items));
    }
}
