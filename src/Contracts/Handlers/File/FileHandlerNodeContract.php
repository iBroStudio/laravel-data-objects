<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Contracts\Handlers\File;

use PhpParser\Node;

interface FileHandlerNodeContract
{
    public static function getValue(Node $node): mixed;

    public function name(): string;

    public function add(mixed $value): self;

    public function replaceBy(mixed $value): self;

    public function value(): mixed;
}
