<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Handlers\File\Php;

use IBroStudio\DataObjects\Contracts\Handlers\File\MethodHandlerContract;
use IBroStudio\DataObjects\Exceptions\FileHandlerMethodAlreadyExistsException;
use IBroStudio\DataObjects\Exceptions\FileHandlerMethodNotFoundException;
use IBroStudio\DataObjects\Handlers\File\Php\Collections\MethodsCollection;
use IBroStudio\DataObjects\Handlers\File\Php\Nodes\MethodNode;
use IBroStudio\DataObjects\Handlers\File\PhpFileHandler;

final class MethodHandler implements MethodHandlerContract
{
    public function __construct(public PhpFileHandler $handler) {}

    /**
     * @throws FileHandlerMethodNotFoundException
     */
    public function find(string $name): MethodNode
    {
        return new MethodNode($this->handler->finder->method($name));
    }

    public function all(): MethodsCollection
    {
        return new MethodsCollection($this->handler->finder->methods());
    }

    /**
     * @throws FileHandlerMethodAlreadyExistsException
     */
    public function add(MethodNode $node): bool
    {
        if (in_array($node->name(), $this->all()->keys()->toArray())) {
            throw new FileHandlerMethodAlreadyExistsException($node->name());
        }

        return $this->handler->class()->node->addToStatement($node);
    }

    /**
     * @throws FileHandlerMethodNotFoundException
     */
    public function remove(string|MethodNode $name): bool
    {
        $node = $name instanceof MethodNode ? $name : $this->find($name);

        return $this->handler->class()->node->removeFromStatement($node);
    }
}
