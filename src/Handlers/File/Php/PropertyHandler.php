<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Handlers\File\Php;

use IBroStudio\DataObjects\Contracts\Handlers\File\FileHandlerNodeContract;
use IBroStudio\DataObjects\Contracts\Handlers\File\PropertyHandlerContract;
use IBroStudio\DataObjects\Exceptions\FileHandlerPropertyNotFoundException;
use IBroStudio\DataObjects\Handlers\File\Php\Collections\PropertiesCollection;
use IBroStudio\DataObjects\Handlers\File\Php\Nodes\NodeObject;
use IBroStudio\DataObjects\Handlers\File\PhpFileHandler;
use PhpParser\Node;

final class PropertyHandler implements PropertyHandlerContract
{
    public Node $node;

    public mixed $value;

    public function __construct(public PhpFileHandler $handler) {}

    /**
     * @throws FileHandlerPropertyNotFoundException
     */
    public function find(string $name): FileHandlerNodeContract
    {
        return NodeObject::make($this->handler->finder->property($name));
    }

    public function all(): PropertiesCollection
    {
        return new PropertiesCollection($this->handler->finder->properties());
    }
}
