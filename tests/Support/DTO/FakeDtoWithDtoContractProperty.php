<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Tests\Support\DTO;

use IBroStudio\DataObjects\Casts\DtoContractCastTransformer;
use IBroStudio\DataObjects\Tests\Support\Contracts\FakeDtoContract;
use Spatie\LaravelData\Attributes\WithCastAndTransformer;
use Spatie\LaravelData\Data;

class FakeDtoWithDtoContractProperty extends Data
{
    public function __construct(
        #[WithCastAndTransformer(DtoContractCastTransformer::class)]
        public FakeDtoContract $dto_with_contract,
    ) {}
}
