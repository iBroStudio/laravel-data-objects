<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Tests\Support\DTO;

use IBroStudio\DataObjects\ValueObjects\ClassString;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class FakeDTOWithCollections extends Data
{
    public function __construct(
        public Collection|Optional $basic_collection,
        /** @var Collection<int, ClassString> */
        public Collection|Optional $vo_collection,
    ) {}
}
