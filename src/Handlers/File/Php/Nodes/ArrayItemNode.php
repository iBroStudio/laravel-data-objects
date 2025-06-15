<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Handlers\File\Php\Nodes;

use IBroStudio\DataObjects\Contracts\Handlers\File\FileHandlerNodeContract;
use IBroStudio\DataObjects\Exceptions\UnhandledValueTypeException;
use PhpParser\Node;

/**
 * @property Node\ArrayItem $node
 */
class ArrayItemNode extends NodeObject implements FileHandlerNodeContract
{
    /**
     * @param  Node\Expr\ArrayItem  $node
     *
     * @throws UnhandledValueTypeException
     */
    public static function getValue(Node $node): mixed
    {
        return parent::getValue($node->value);
    }

    /**
     * @throws UnhandledValueTypeException
     */
    public function add(mixed $value): self
    {
        if (isset($this->node->value->items)) {
            $this->node->value->items = [...$this->node->value->items, ...static::wrap($value)];
        }

        return $this;
    }

    /**
     * @throws UnhandledValueTypeException
     */
    public function replaceBy(mixed $value): self
    {
        if (isset($this->node->value->items)) {
            $this->node->value->items = static::wrap($value);
        } else {
            $this->node->value = static::wrap($value);
        }

        return $this;
    }
}
