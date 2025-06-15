<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Handlers\File\Php;

use IBroStudio\DataObjects\Contracts\Handlers\File\ClassHandlerContract;
use IBroStudio\DataObjects\Exceptions\FileHandlerClassNotFoundException;
use IBroStudio\DataObjects\Handlers\File\Php\Nodes\ClassNode;
use IBroStudio\DataObjects\Handlers\File\PhpFileHandler;

final class ClassHandler implements ClassHandlerContract
{
    public ClassNode $node;

    /**
     * @throws FileHandlerClassNotFoundException
     */
    public function __construct(public PhpFileHandler $handler)
    {
        $this->node = new ClassNode($this->handler->finder->class());
    }
}
