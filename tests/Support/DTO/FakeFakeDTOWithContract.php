<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Tests\Support\DTO;

use IBroStudio\DataObjects\Tests\Support\Contracts\FakeDtoContract;
use Spatie\LaravelData\Data;

class FakeFakeDTOWithContract extends Data implements FakeDtoContract
{
    public function __construct(
        public string $name,
    ) {}
}
