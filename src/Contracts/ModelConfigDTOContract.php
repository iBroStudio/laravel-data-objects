<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Contracts;

use Illuminate\Support\Collection;

interface ModelConfigDTOContract
{
    public function getCasts(): Collection;
}
