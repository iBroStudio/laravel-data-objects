<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Handlers\File\Php;

use IBroStudio\DataObjects\Contracts\Handlers\File\FileHandlerContract;
use IBroStudio\DataObjects\Enums\FileHandlerTypeEnum;
use IBroStudio\DataObjects\Exceptions\FileHandlerClassNotFoundException;
use IBroStudio\DataObjects\Exceptions\FileHandlerMethodNotFoundException;
use IBroStudio\DataObjects\Exceptions\FileHandlerNamespaceNotFoundException;
use IBroStudio\DataObjects\Exceptions\FileHandlerPropertyNotFoundException;
use Illuminate\Support\Str;
use PhpParser\Node;
use PhpParser\NodeFinder;

class Finder
{
    private NodeFinder $nodeFinder;

    public function __construct(public FileHandlerContract $handler)
    {
        $this->nodeFinder = new NodeFinder();
    }

    /**
     * @throws FileHandlerNamespaceNotFoundException
     */
    public function namespace(): mixed
    {
        $namespace = $this->nodeFinder->findFirstInstanceOf($this->handler->statement, Node\Stmt\Namespace_::class);

        if (is_null($namespace)) {
            throw new FileHandlerNamespaceNotFoundException;
        }

        return $namespace;
    }

    public function imports(): mixed
    {
        return $this->nodeFinder->findInstanceOf($this->handler->statement, Node\Stmt\Use_::class);
    }

    public function class(): mixed
    {
        $class = $this->nodeFinder->findFirstInstanceOf($this->handler->statement, Node\Stmt\Class_::class);

        if (is_null($class)) {
            throw new FileHandlerClassNotFoundException;
        }

        return $class;
    }

    public function method(string $name): mixed
    {
        $method = $this->nodeFinder->findFirst($this->handler->statement,
            fn (Node $node) => $node instanceof Node\Stmt\ClassMethod && $node->name->toString() === $name
        );

        if (is_null($method)) {
            throw new FileHandlerMethodNotFoundException($name);
        }

        return $method;
    }

    public function methods(): mixed
    {
        return $this->nodeFinder->findInstanceOf($this->handler->statement, Node\Stmt\ClassMethod::class);
    }

    /**
     * @throws FileHandlerPropertyNotFoundException
     */
    public function property(string $name): mixed
    {
        $node = Str::of($name)
            ->explode('.')
            ->reduce(function (mixed $carry, string $segment) {

                return $this->nodeFinder->findFirst($carry, function (Node $node) use ($segment) {
                    return match (true) {
                        $node instanceof Node\Stmt\Property => $node->props[0]->name->toString() === $segment,
                        $node instanceof Node\ArrayItem => isset($node->key->value) && $node->key->value === $segment,
                        default => false,
                    };
                });

            }, $this->handler->statement);

        if (is_null($node)) {
            throw new FileHandlerPropertyNotFoundException($name);
        }

        return $node instanceof Node\Stmt\Property ? $node->props[0]->default : $node;
    }

    public function properties(): mixed
    {
        return match ($this->handler->fileType) {

            FileHandlerTypeEnum::ArrayFile => $this->nodeFinder->findFirstInstanceOf($this->handler->statement, Node\Expr\Array_::class),

            FileHandlerTypeEnum::ClassFile => $this->nodeFinder->findInstanceOf($this->handler->statement, Node\Stmt\Property::class),
        };
    }
}
