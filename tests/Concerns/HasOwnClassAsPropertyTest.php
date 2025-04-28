<?php

declare(strict_types=1);

use IBroStudio\DataObjects\Tests\Support\Models\FakeChildModel;
use IBroStudio\DataObjects\Tests\Support\Models\FakeDataOwner;

it('can append model own class as property', function () {
    expect(
        FakeDataOwner::factory()->create()->class
    )->toBe(FakeDataOwner::class);
});

it('can customize own class property name', function () {
    expect(
        FakeChildModel::factory()->create()->type
    )->toBe(FakeChildModel::class);
});

it('can filter models with a global scope from class property', function () {
    FakeDataOwner::factory()->count(5)->create();
    FakeChildModel::factory()->count(5)->create();

    expect(FakeDataOwner::count())->toBe(5)
        ->and(FakeChildModel::count())->toBe(5)
        ->and(FakeDataOwner::withoutGlobalScope('class')->count())->toBe(10);
});
