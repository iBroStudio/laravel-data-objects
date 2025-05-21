<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Tests\Support\DTO;

use IBroStudio\DataObjects\Attributes\EloquentCast;
use IBroStudio\DataObjects\Dto\ModelConfigDto;
use IBroStudio\DataObjects\ValueObjects\ClassString;
use Illuminate\Support\Collection;

class FakeModelConfigDto extends ModelConfigDto
{
    public function __construct(
        #[EloquentCast]
        public ClassString $configClass,
        /** @var Collection<int, ClassString> */
        public Collection $configCollection
    ) {}
}
