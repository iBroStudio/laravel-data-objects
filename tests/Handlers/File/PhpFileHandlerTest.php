<?php

declare(strict_types=1);

use IBroStudio\DataObjects\Contracts\Handlers\File\ClassHandlerContract;
use IBroStudio\DataObjects\Contracts\Handlers\File\ImportHandlerContract;
use IBroStudio\DataObjects\Contracts\Handlers\File\MethodHandlerContract;
use IBroStudio\DataObjects\Contracts\Handlers\File\NamespaceHandlerContract;
use IBroStudio\DataObjects\Contracts\Handlers\File\PropertyHandlerContract;
use IBroStudio\DataObjects\Enums\FileHandlerTypeEnum;
use IBroStudio\DataObjects\Handlers\File\Php\Finder;
use IBroStudio\DataObjects\Handlers\File\PhpFileHandler;
use PhpParser\Node;

it('can instantiate PhpFileHandler', function () {
    $file = data_file('TestServiceProvider.php');

    expect($file->handler)->toBeInstanceOf(PhpFileHandler::class);
});

it('can parse php file', function () {
    $file = data_file('TestServiceProvider.php');

    expect(current($file->handler->statement))->toBeInstanceOf(Node::class)
        ->and($file->handler->fileType)->toBe(FileHandlerTypeEnum::ClassFile)
        ->and($file->handler->finder)->toBeInstanceOf(Finder::class);
});

it('can return namespace handler', function () {
    $file = data_file('TestServiceProvider.php');

    expect($file->handler->namespace())->toBeInstanceOf(NamespaceHandlerContract::class);
});

it('can return class handler', function () {
    $file = data_file('TestServiceProvider.php');

    expect($file->handler->class())->toBeInstanceOf(ClassHandlerContract::class);
});

it('can return imports handler', function () {
    $file = data_file('TestServiceProvider.php');

    expect($file->handler->imports())->toBeInstanceOf(ImportHandlerContract::class);
});

it('can return properties handler', function () {
    $file = data_file('TestServiceProvider.php');

    expect($file->handler->properties())->toBeInstanceOf(PropertyHandlerContract::class);
});

it('can return methods handler', function () {
    $file = data_file('TestServiceProvider.php');

    expect($file->handler->methods())->toBeInstanceOf(MethodHandlerContract::class);
});

it('can print file statement', function () {
    $file = data_file('TestServiceProvider.php');

    expect($file->handler->print())->toBeString();
});

it('can save file', function () {
    $file = data_file('DataFile/FakeArray.php');
    $property = $file->properties()->find('arrayProp')->add(['value-3']);
    $file->save();

    expect(Str::squish($file->content(refresh: true)))
        ->toContain('\'arrayProp\' => [\'value-1\', \'value-2\', \'value-3\'],');

    $property->replaceBy(['value-1', 'value-2']);
    $file->save();
});

it('can add and remove data to a file from a stub', function () {
    $file = data_file('DataFile/FakeClass.php');
    $stub = data_file('Stubs/methods.installer.hooks.stub');

    expect($file->methods()->all()->has('hooks'))->toBeFalse()
        ->and($file->imports()->all()->has('IBroStudio\ModuleHelper\Install\InstallManager'))->toBeFalse()
        ->and($file->imports()->all()->has('ModuleNamespace\Hook\HookManager'))->toBeFalse();

    $file->handler->addFromStub($stub);

    expect($file->methods()->all()->has('hooks'))->toBeTrue()
        ->and($file->imports()->all()->has('IBroStudio\ModuleHelper\Install\InstallManager'))->toBeTrue()
        ->and($file->imports()->all()->has('ModuleNamespace\Hook\HookManager'))->toBeTrue();

    $file->handler->removeStub($stub);

    $file = data_file('DataFile/FakeClass.php');

    expect($file->methods()->all()->has('hooks'))->toBeFalse()
        ->and($file->imports()->all()->has('IBroStudio\ModuleHelper\Install\InstallManager'))->toBeFalse()
        ->and($file->imports()->all()->has('ModuleNamespace\Hook\HookManager'))->toBeFalse();
});
