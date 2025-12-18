<?php

declare(strict_types=1);

use Carbon\CarbonImmutable;
use IBroStudio\DataObjects\Handlers\File\Php\Nodes\NodeObject;
use IBroStudio\DataObjects\ValueObjects\ClassString;

pest()->group('data-file');

it('can return properties from a class', function () {
    $file = data_file('DataFile/FakeClass.php');
    $properties = $file->properties()->all();

    expect($properties)->toBeCollection()
        ->and($properties->first())->toBeInstanceOf(NodeObject::class);
});

it('can return a property from a class', function (string $key, mixed $expected) {
    $file = data_file('DataFile/FakeClass.php');
    $property = $file->properties()->find($key);

    expect($property->value())->toEqual($expected);
})->with([
    ['VERSION', '8.2.0'],
    ['stringProp', 'test'],
    ['intProp', 21],
    ['floatProp', 2.1],
    ['arrayProp', ['value-1', 'value-2']],
    ['indexedArrayProp', ['test-1' => 'value-1', 'test-2' => 'value-2']],
    ['nestedArrayProp', ['test-1' => ['nested-value-1'], 'test-2' => ['nested-key-2' => 'nested-value-2']]],
]);

it('can return class string value from a class', function () {
    $file = data_file('DataFile/FakeClass.php');
    $property = $file->properties()->find('classStringProp');

    expect($property->value())->toEqual(CarbonImmutable::class);
});

it('can return array with class string value from a class', function () {
    $file = data_file('DataFile/FakeClass.php');
    $property = $file->properties()->find('classStringArrayValueProp');

    expect($property->value())->toMatchArray([CarbonImmutable::class]);
});

it('can return array with class string index from a class', function () {
    $file = data_file('DataFile/FakeClass.php');
    $property = $file->properties()->find('classStringArrayIndexProp');

    expect($property->value())->toMatchArray([CarbonImmutable::class => 'value-1']);
});

it('can return a value from a nested array', function () {
    $file = data_file('DataFile/FakeClass.php');
    $property = $file->properties()->find('nestedArrayProp.test-2');

    expect($property->value())->toMatchArray(['nested-key-2' => 'nested-value-2']);
});

it('can replace a string value in a class', function () {
    $file = data_file('DataFile/FakeClass.php');
    $property = $file->properties()->find('stringProp')
        ->replaceBy('new');
    $file->save();

    expect($property->value())->toEqual('new')
        ->and($file->content(refresh: true))
        ->toContain('public string $stringProp = \'new\';');

    $property->replaceBy('test');
    $file->save();
});

it('can replace an int value in a class', function () {
    $file = data_file('DataFile/FakeClass.php');
    $property = $file->properties()->find('intProp')
        ->replaceBy(27);
    $file->save();

    expect($property->value())->toEqual(27)
        ->and($file->content(refresh: true))
        ->toContain('public int $intProp = 27;');

    $property->replaceBy(21);
    $file->save();
});

it('can replace an float value in a class', function () {
    $file = data_file('DataFile/FakeClass.php');
    $property = $file->properties()->find('floatProp')
        ->replaceBy(2.7);
    $file->save();

    expect($property->value())->toEqual(2.7)
        ->and($file->content(refresh: true))
        ->toContain('public float $floatProp = 2.7;');

    $property->replaceBy(2.1);
    $file->save();
});

it('can replace an array in a class', function () {
    $file = data_file('DataFile/FakeClass.php');
    $property = $file->properties()->find('arrayProp')
        ->replaceBy(['value-3', ClassString::from(CarbonImmutable::class)]);
    $file->save();

    expect($property->value())->toMatchArray(['value-3', CarbonImmutable::class])
        ->and($file->content(refresh: true))
        ->toContain('public array $arrayProp = [\'value-3\', \Carbon\CarbonImmutable::class];');

    $property->replaceBy(['value-1', 'value-2']);
    $file->save();
});

it('can replace an indexed in from a class', function () {
    $file = data_file('DataFile/FakeClass.php');
    $property = $file->properties()->find('indexedArrayProp')
        ->replaceBy(['test-3' => 'value-3', 'test-4' => 'value-4']);
    $file->save();

    expect($property->value())->toMatchArray(['test-3' => 'value-3', 'test-4' => 'value-4'])
        ->and($file->content(refresh: true))
        ->toContain('public array $indexedArrayProp = [\'test-3\' => \'value-3\', \'test-4\' => \'value-4\'];');

    $property->replaceBy(['test-1' => 'value-1', 'test-2' => 'value-2']);
    $file->save();
});

it('can replace a value in a nested array', function () {
    $file = data_file('DataFile/FakeClass.php');
    $property = $file->properties()->find('nestedArrayProp.test-2')
        ->replaceBy(['nested-key-new' => 'nested-value-new']);
    $file->save();

    expect($property->value())->toMatchArray(['nested-key-new' => 'nested-value-new'])
        ->and($file->content(refresh: true))
        ->toContain('public array $nestedArrayProp = [\'test-1\' => [\'nested-value-1\'], \'test-2\' => [\'nested-key-new\' => \'nested-value-new\']];');

    $property->replaceBy(['nested-key-2' => 'nested-value-2']);
    $file->save();
});

it('can empty an array', function () {
    $file = data_file('DataFile/FakeClass.php');
    $property = $file->properties()->find('indexedArrayProp')
        ->replaceBy([]);

    expect($property->value())->toBe([]);
});

it('can add an item to an array', function () {
    $file = data_file('DataFile/FakeClass.php');
    $property = $file->properties()->find('arrayProp')
        ->add(['value-3', ClassString::from(CarbonImmutable::class)]);
    $file->save();

    expect($property->value())->toMatchArray(['value-1', 'value-2', 'value-3', CarbonImmutable::class])
        ->and($file->content(refresh: true))
        ->toContain('public array $arrayProp = [\'value-1\', \'value-2\', \'value-3\', \Carbon\CarbonImmutable::class];');

    $property->replaceBy(['value-1', 'value-2']);
    $file->save();
});

it('can add an item to an indexed array', function () {
    $file = data_file('DataFile/FakeClass.php');
    $property = $file->properties()->find('indexedArrayProp')
        ->add(['test-3' => 'value-3', 'test-4' => 'value-4']);
    $file->save();

    expect($property->value())->toMatchArray(['test-1' => 'value-1', 'test-2' => 'value-2', 'test-3' => 'value-3', 'test-4' => 'value-4'])
        ->and($file->content(refresh: true))
        ->toContain('public array $indexedArrayProp = [\'test-1\' => \'value-1\', \'test-2\' => \'value-2\', \'test-3\' => \'value-3\', \'test-4\' => \'value-4\'];');

    $property->replaceBy(['test-1' => 'value-1', 'test-2' => 'value-2']);
    $file->save();
});

it('can add a value to a nested array', function () {
    $file = data_file('DataFile/FakeClass.php');
    $property = $file->properties()->find('nestedArrayProp.test-2')
        ->add(['nested-key-new' => 'nested-value-new']);
    $file->save();

    expect($property->value())->toMatchArray(['nested-key-2' => 'nested-value-2', 'nested-key-new' => 'nested-value-new'])
        ->and($file->content(refresh: true))
        ->toContain('public array $nestedArrayProp = [\'test-1\' => [\'nested-value-1\'], \'test-2\' => [\'nested-key-2\' => \'nested-value-2\', \'nested-key-new\' => \'nested-value-new\']];');

    $property->replaceBy(['nested-key-2' => 'nested-value-2']);
    $file->save();
});

it('can add a value with class string index', function () {
    $file = data_file('DataFile/FakeClass.php');
    $property = $file->properties()->find('classStringArrayIndexProp')
        ->replaceBy([])
        ->add([NodeObject::class => []]);

    expect($property->value())->toMatchArray([NodeObject::class => []]);

    $property->replaceBy([])
        ->add([NodeObject::class => ['test-1' => 'value-1']]);

    expect($property->value())->toMatchArray([NodeObject::class => ['test-1' => 'value-1']]);

    $property->replaceBy([])
        ->add([NodeObject::class => [CarbonImmutable::class => 'value-2']]);

    expect($property->value())->toMatchArray([NodeObject::class => [CarbonImmutable::class => 'value-2']]);
});

it('can register a hook', function () {
    $file = data_file('DataFile/FakeClass.php');
    $file->properties()->find('hooks')
        ->replaceBy([])
        ->add([NodeObject::class => []]);

    $file->save();

    $file = data_file('DataFile/FakeClass.php');
    $property = $file->properties()->find('hooks');

    expect($property->value())->toMatchArray([NodeObject::class => []]);
});
