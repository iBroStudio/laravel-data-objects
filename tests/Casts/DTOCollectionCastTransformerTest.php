<?php

use IBroStudio\DataObjects\Tests\Support\DTO\FakeDTOWithCollections;
use IBroStudio\DataObjects\ValueObjects\ClassString;
use Illuminate\Support\Collection;

it('can cast DTO property with collection', function () {
    FakeDTOWithCollections::from([
        'basic_collection' => [fake()->word, fake()->word, fake()->word],
    ]);
})->throwsNoExceptions();

it('can cast DTO property with collection of value objects', function () {
    $dto = FakeDTOWithCollections::from([
        'vo_collection' => [ClassString::class, ClassString::class, ClassString::class],
    ]);

    expect($dto->vo_collection)->toBeInstanceOf(Collection::class)
        ->and($dto->vo_collection->first())->toBeInstanceOf(ClassString::class);
});
