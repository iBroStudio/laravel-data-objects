<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Contracts\Handlers\File;

use IBroStudio\DataObjects\Handlers\File\Php\Collections\ImportsCollection;
use IBroStudio\DataObjects\Handlers\File\Php\Nodes\ImportNode;

interface ImportHandlerContract
{
    public function all(): ImportsCollection;

    public function add(ImportNode $node): bool;
}
