<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Tests\Support\DTO;

use IBroStudio\DataObjects\Attributes\EloquentCast;
use IBroStudio\DataObjects\DTO\ModelConfigDTO;
use IBroStudio\DataObjects\ValueObjects\ClassString;
use Illuminate\Support\Collection;

class FakeModelConfigDTO extends ModelConfigDTO
{
    public function __construct(
        #[EloquentCast]
        public ClassString $configClass,
        /** @var Collection<int, ClassString> */
        public Collection $configCollection
    ) {}
}
