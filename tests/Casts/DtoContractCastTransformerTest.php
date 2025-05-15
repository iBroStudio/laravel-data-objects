<?php

declare(strict_types=1);

use IBroStudio\DataObjects\Tests\Support\DTO\FakeDtoWithDtoContractProperty;
use IBroStudio\DataObjects\Tests\Support\DTO\FakeFakeDTOWithContract;

it('can cast DTO property with contract', function () {
    FakeDtoWithDtoContractProperty::from([
        'dto_with_contract' => [
            'name' => fake()->word,
            'dto_concrete_class' => FakeFakeDTOWithContract::class,
        ],
    ]);
})->throwsNoExceptions();

it('can transform DTO property with contract', function () {
    $dto = FakeDtoWithDtoContractProperty::from([
        'dto_with_contract' => FakeFakeDTOWithContract::from(['name' => fake()->word]),
    ]);

    FakeDtoWithDtoContractProperty::from($dto->toArray());
})->throwsNoExceptions();
