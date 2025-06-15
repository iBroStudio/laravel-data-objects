<?php

declare(strict_types=1);

use IBroStudio\DataObjects\Handlers\File\Php\Nodes\MethodNode;

pest()->group('data-file');

it('can return all methods from a class', function () {
    $file = stub_file('Stubs/methods.installer.hooks.stub');
    $methods = $file->methods()->all();

    expect($methods)->toBeCollection()
        ->and($methods->first())->toBeInstanceOf(MethodNode::class);
});

it('can return a method from a class', function () {
    $file = stub_file('Stubs/methods.installer.hooks.stub');

    expect($file->methods()->find('hooks'))->toBeInstanceOf(MethodNode::class);
});

it('can add a method to a class', function () {
    $file = data_file('DataFile/FakeClass.php');
    $stub = stub_file('Stubs/methods.installer.hooks.stub');

    expect($file->methods()->all()->has('hooks'))->toBeFalse();

    $file->methods()->add($stub->methods()->find('hooks'));

    expect($file->methods()->all()->has('hooks'))->toBeTrue();
});

it('can remove a method from a class', function () {
    $file = data_file('DataFile/FakeClass.php');

    expect($file->methods()->all()->has('testMethod'))->toBeTrue();

    $file->methods()->remove('testMethod');

    expect($file->methods()->all()->has('testMethod'))->toBeFalse();
});
