<?php

declare(strict_types=1);

use IBroStudio\DataObjects\ValueObjects\ClassString;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Validation\ValidationException;

it('can instantiate ClassString object value', function () {
    expect(ClassString::from('My\Test\Class'))
        ->toBeInstanceOf(ClassString::class);
});

it('can validate ClassString object value', function () {
    ClassString::from('');
})->throws(ValidationException::class);

it('can validate that ClassString exists as class', function () {
    expect(
        ClassString::from(ClassString::class)->classExists()
    )
        ->toBeTrue()
        ->and(
            ClassString::from('My\Test\Class')->classExists()
        )
        ->toBeFalse();
});

it('can validate that ClassString exists as interface', function () {
    expect(
        ClassString::from(Arrayable::class)->interfaceExists()
    )
        ->toBeTrue()
        ->and(
            ClassString::from('My\Test\Class')->interfaceExists()
        )
        ->toBeFalse();
});

it('can instantiate ClassString class', function () {
    $classString = ClassString::from('Exception');

    expect($classString->instantiate())
        ->toBeInstanceOf(Exception::class)
        ->and($classString->instantiateWith(['message' => 'test']))
        ->toEqual(new Exception('test'));
});

it('can return ClassString object value as string', function () {
    expect(ClassString::from('My\Test\Class')->toString())
        ->toBe('My\Test\Class');
});

it('can return ClassString object value as array', function () {
    expect(
        ClassString::from('test')->toArray()
    )->toMatchArray([
        0 => 'test',
    ]);
});

it('can return ClassString object value as json', function () {
    expect(
        ClassString::from('test')->toJson()
    )->toBe('["test"]');
});
