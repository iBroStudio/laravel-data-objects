<?php

declare(strict_types=1);

use Carbon\CarbonImmutable;
use IBroStudio\DataObjects\Exceptions\FileHandlerPropertyNotFoundException;
use IBroStudio\DataObjects\Handlers\File\Php\Nodes\NodeObject;
use IBroStudio\DataObjects\ValueObjects\ClassString;
use Illuminate\Support\Str;

pest()->group('data-file');

it('can return properties from an array file', function () {
    $file = data_file('DataFile/FakeArray.php');
    $properties = $file->properties()->all();

    expect($properties)->toBeCollection()
        ->and($properties->first())->toBeInstanceOf(NodeObject::class)
        ->and($properties->values())->toMatchArray([
            'stringProp' => 'value-1',
            'intProp' => 21,
            'floatProp' => 2.1,
            'arrayProp' => ['value-1', 'value-2'],
            'indexedArrayProp' => [
                'test-1' => 'value-1',
                'test-2' => 'value-2',
            ],
            'nestedArrayProp' => [
                'test-1' => 'nested-value-1',
                'test-2' => ['nested-key-2' => 'nested-value-2'],
            ],
            'classStringProp' => CarbonImmutable::class,
            'classStringArrayIndexProp' => [CarbonImmutable::class => 'value-1'],
        ]);

});

it('can return a single value from an array file', function () {
    $file = data_file('DataFile/FakeArray.php');
    $property = $file->handler->properties()->find('stringProp');

    expect($property->value())->toEqual('value-1');
});

it('can return a value from a nested array', function () {
    $file = data_file('DataFile/FakeArray.php');
    $property = $file->properties()->find('nestedArrayProp.test-2');

    expect($property->value())->toMatchArray(['nested-key-2' => 'nested-value-2']);
});

it('can replace a string value in an array file', function () {
    $file = data_file('DataFile/FakeArray.php');
    $property = $file->properties()->find('stringProp')->replaceBy('new');
    $file->save();

    expect($property->value())->toEqual('new')
        ->and($file->content(refresh: true))
        ->toContain('\'stringProp\' => \'new\',');

    $property->replaceBy('value-1');
    $file->save();
});

it('can replace an int value in an array file', function () {
    $file = data_file('DataFile/FakeArray.php');
    $property = $file->properties()->find('intProp')->replaceBy(27);
    $file->save();

    expect($property->value())->toEqual(27)
        ->and($file->content(refresh: true))
        ->toContain('\'intProp\' => 27,');

    $property->replaceBy(21);
    $file->save();
});

it('can replace an float value in an array file', function () {
    $file = data_file('DataFile/FakeArray.php');
    $property = $file->properties()->find('floatProp')->replaceBy(2.7);
    $file->save();

    expect($property->value())->toEqual(2.7)
        ->and($file->content(refresh: true))
        ->toContain('\'floatProp\' => 2.7,');

    $property->replaceBy(2.1);
    $file->save();
});

it('can replace an array in an array file', function () {
    $file = data_file('DataFile/FakeArray.php');
    $property = $file->properties()->find('arrayProp')->replaceBy(['value-3', ClassString::from(CarbonImmutable::class)]);
    $file->save();

    expect($property->value())->toMatchArray(['value-3', CarbonImmutable::class])
        ->and($file->content(refresh: true))
        ->toContain('\'arrayProp\' => [\'value-3\', Carbon\CarbonImmutable::class],');

    $property->replaceBy(['value-1', 'value-2']);
    $file->save();
});

it('can replace an indexed in from an array file', function () {
    $file = data_file('DataFile/FakeArray.php');
    $property = $file->properties()->find('indexedArrayProp')->replaceBy(['test-3' => 'value-3', 'test-4' => 'value-4']);
    $file->save();

    expect($property->value())->toMatchArray(['test-3' => 'value-3', 'test-4' => 'value-4'])
        ->and(Str::squish($file->content(refresh: true)))
        ->toContain('\'indexedArrayProp\' => [\'test-3\' => \'value-3\', \'test-4\' => \'value-4\'],');

    $property->replaceBy(['test-1' => 'value-1', 'test-2' => 'value-2']);
    $file->save();
});

it('can replace a value in a nested array', function () {
    $file = data_file('DataFile/FakeArray.php');
    $property = $file->properties()->find('nestedArrayProp.test-2')->replaceBy(['nested-key-new' => 'nested-value-new']);
    $file->save();

    expect($property->value())->toMatchArray(['nested-key-new' => 'nested-value-new'])
        ->and(Str::squish($file->content(refresh: true)))
        ->toContain('\'nestedArrayProp\' => [\'test-1\' => \'nested-value-1\', \'test-2\' => [\'nested-key-new\' => \'nested-value-new\']],');

    $property->replaceBy(['nested-key-2' => 'nested-value-2']);
    $file->save();
});

it('can add an item to an array', function () {
    $file = data_file('DataFile/FakeArray.php');
    $property = $file->properties()->find('arrayProp')->add(['value-3', ClassString::from(CarbonImmutable::class)]);
    $file->save();

    expect($property->value())->toMatchArray(['value-1', 'value-2', 'value-3', CarbonImmutable::class])
        ->and(Str::squish($file->content(refresh: true)))
        ->toContain('\'arrayProp\' => [\'value-1\', \'value-2\', \'value-3\', Carbon\CarbonImmutable::class],');

    $property->replaceBy(['value-1', 'value-2']);
    $file->save();
});

it('can add an item to an indexed array', function () {
    $file = data_file('DataFile/FakeArray.php');
    $property = $file->properties()->find('indexedArrayProp')->add(['test-3' => 'value-3', 'test-4' => 'value-4']);
    $file->save();

    expect($property->value())->toMatchArray(['test-1' => 'value-1', 'test-2' => 'value-2', 'test-3' => 'value-3', 'test-4' => 'value-4'])
        ->and(Str::squish($file->content(refresh: true)))
        ->toContain('\'indexedArrayProp\' => [\'test-1\' => \'value-1\', \'test-2\' => \'value-2\', \'test-3\' => \'value-3\', \'test-4\' => \'value-4\'],');

    $property->replaceBy(['test-1' => 'value-1', 'test-2' => 'value-2']);
    $file->save();
});

it('can add a value to a nested array', function () {
    $file = data_file('DataFile/FakeArray.php');
    $property = $file->properties()->find('nestedArrayProp.test-2')->add(['nested-key-new' => 'nested-value-new']);
    $file->save();

    expect($property->value())->toMatchArray(['nested-key-2' => 'nested-value-2', 'nested-key-new' => 'nested-value-new'])
        ->and(Str::squish($file->content(refresh: true)))
        ->toContain('\'nestedArrayProp\' => [\'test-1\' => \'nested-value-1\', \'test-2\' => [\'nested-key-2\' => \'nested-value-2\', \'nested-key-new\' => \'nested-value-new\']],');

    $property->replaceBy(['nested-key-2' => 'nested-value-2']);
    $file->save();
});

it('throws error if property is not found', function () {
    $file = data_file('DataFile/FakeArray.php');
    $file->properties()->find('unknownProperty');
})->throws(FileHandlerPropertyNotFoundException::class);
