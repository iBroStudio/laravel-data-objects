<?php

declare(strict_types=1);

use IBroStudio\DataObjects\Rules\ClassStringRule;
use Illuminate\Validation\ValidationException;

it('passes validation with valid class string values', function () {
    Validator::make(
        [
            'attribute1' => stdClass::class,
            'attribute2' => DateTimeImmutable::class,
            'attribute3' => Exception::class,
            'attribute4' => Closure::class,
            'attribute5' => IBroStudio\DataObjects\ValueObjects\ClassString::class,
            'attribute6' => ClassStringRule::class,
            'attribute7' => ValidationException::class,
            'attribute8' => Illuminate\Support\Collection::class,
        ],
        [
            'attribute1' => new ClassStringRule(),
            'attribute2' => new ClassStringRule(),
            'attribute3' => new ClassStringRule(),
            'attribute4' => new ClassStringRule(),
            'attribute5' => new ClassStringRule(),
            'attribute6' => new ClassStringRule(),
            'attribute7' => new ClassStringRule(),
            'attribute8' => new ClassStringRule(),
        ]
    )
        ->validate();

    expect(true)->toBeTrue();
});

it('passes validation with null value', function () {
    Validator::make(
        ['attribute' => null],
        ['attribute' => new ClassStringRule()]
    )
        ->validate();

    expect(true)->toBeTrue();
});

it('fails validation with invalid value', function () {
    Validator::make(
        ['attribute' => 'NonExistentClass'],
        ['attribute' => new ClassStringRule()]
    )
        ->validate();
})->throws(ValidationException::class);
