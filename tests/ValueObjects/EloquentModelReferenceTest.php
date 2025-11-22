<?php

declare(strict_types=1);

use IBroStudio\DataObjects\Tests\Support\Models\FakeChildModel;
use IBroStudio\DataObjects\ValueObjects\ClassString;
use IBroStudio\DataObjects\ValueObjects\EloquentModelReference;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

it('can instantiate EloquentModelReference object value', function () {
    $model = FakeChildModel::factory()->create();

    expect(EloquentModelReference::from($model))
        ->toBeInstanceOf(EloquentModelReference::class);
});

it('can validate EloquentModelReference object value', function () {
    EloquentModelReference::from(ClassString::class);
})->throws(ValidationException::class);


it('can return Eloquent Model', function () {
    $model = FakeChildModel::factory()->create();
    $ov = EloquentModelReference::from($model);

    expect($ov->value)
        ->toBeInstanceOf(Model::class)
        ->and($ov->value->is($model))
        ->toBeTrue();
});

it('can return EloquentModelReference object value as array', function () {
    $model = FakeChildModel::factory()->create();

    expect(
        EloquentModelReference::from($model)->toArray()
    )->toMatchArray([
        'class' => FakeChildModel::class,
        'id' => 1,
    ]);
});

it('can retrieve EloquentModelReference from array', function () {
    $model = FakeChildModel::factory()->create();
    $array = EloquentModelReference::from($model)->toArray();

    $ov = EloquentModelReference::from($array);

    expect($ov->value)
        ->toBeInstanceOf(Model::class)
        ->and($ov->value->is($model))
        ->toBeTrue();
});
