<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Tests\Support\DTO;

use Spatie\LaravelData\Data;

class SimpleFakeDTO extends Data
{
    public function __construct(
        public string $name,
        public int $age,
        public array $roles = []
    ) {}
}
