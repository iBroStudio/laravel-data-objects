<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Contracts\Handlers\File;

use IBroStudio\DataObjects\Handlers\File\Php\Collections\MethodsCollection;
use IBroStudio\DataObjects\Handlers\File\Php\Nodes\MethodNode;

interface MethodHandlerContract
{
    public function find(string $name): MethodNode;

    public function all(): MethodsCollection;

    public function add(MethodNode $node): bool;

    public function remove(MethodNode $node): bool;
}
