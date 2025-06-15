<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Handlers\File\Php\Nodes;

use IBroStudio\DataObjects\Contracts\Handlers\File\FileHandlerNodeContract;
use IBroStudio\DataObjects\Exceptions\UnhandledValueTypeException;
use PhpParser\Node;

/**
 * @property Node\Expr\Array_ $node
 */
class ArrayNode extends NodeObject implements FileHandlerNodeContract
{
    /**
     * @param  Node\Expr\Array_  $node
     */
    public static function getValue(Node $node): mixed
    {
        return collect($node->items)
            ->mapWithKeys(function (mixed $item, int|string $key) {
                return [
                    (isset($item->key) ? parent::getValue($item->key) : $key) => ArrayItemNode::getValue($item),
                ];
            })
            ->toArray();
    }

    /**
     * @throws UnhandledValueTypeException
     */
    public function add(mixed $value): self
    {
        $this->node->items = [...$this->node->items, ...static::wrap($value)];

        return $this;
    }

    /**
     * @throws UnhandledValueTypeException
     */
    public function replaceBy(mixed $value): self
    {
        $this->node->items = static::wrap($value);

        return $this;
    }
}
