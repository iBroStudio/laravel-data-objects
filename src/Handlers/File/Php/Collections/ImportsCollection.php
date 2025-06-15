<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Handlers\File\Php\Collections;

use IBroStudio\DataObjects\Handlers\File\Php\Nodes\ImportNode;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use PhpParser\Node;

class ImportsCollection extends Collection
{
    public function __construct($items = [])
    {
        parent::__construct(
            Arr::mapWithKeys($items, fn (Node\Stmt\Use_ $item) => [$item->uses[0]->name->toString() => new ImportNode($item)])
        );
    }

    public function keys(): Collection|self
    {
        // @phpstan-ignore-next-line
        return new Collection(array_keys($this->items));
    }
}
