<?php

declare(strict_types=1);

use IBroStudio\DataObjects\Contracts\ModelConfigDTOContract;
use IBroStudio\DataObjects\Tests\Support\Models\FakeDataOwner;
use IBroStudio\DataObjects\ValueObjects\ClassString;

it('can return model DTO config', function () {
    expect(
        FakeDataOwner::factory()->create()
            ->config
    )->toBeInstanceOf(ModelConfigDTOContract::class);
});

it('can return DTO casts for model properties', function () {
    expect(
        FakeDataOwner::factory()->create()
            ->config
            ->getCasts()
            ->toArray()
    )->toMatchArray(['configClass' => ClassString::class]);
});

it('can add DTO casts to model casts', function () {
    $model = FakeDataOwner::factory()->create();

    expect(
        Arr::has($model->getCasts(), 'configClass')
    )->toBeTrue()
        ->and(Arr::get($model->getCasts(), 'configClass'))->toBe(ClassString::class);
});
