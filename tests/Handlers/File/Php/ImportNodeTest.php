<?php

declare(strict_types=1);

pest()->group('data-file');

it('can return all imports from a class', function () {
    $file = stub_file('Stubs/methods.installer.hooks.stub');
    $imports = $file->imports()->all();

    expect($imports)->toBeCollection()
        ->and($imports->has('IBroStudio\ModuleHelper\Install\InstallManager'))->toBeTrue()
        ->and($imports->has('ModuleNamespace\Hook\HookManager'))->toBeTrue();
});

it('can add an import to a class', function () {
    $file = data_file('DataFile/FakeClass.php');
    $stub = stub_file('Stubs/methods.installer.hooks.stub');
    $imports = $file->imports();

    expect($imports->all()->has('IBroStudio\ModuleHelper\Install\InstallManager'))->toBeFalse()
        ->and($imports->all()->has('ModuleNamespace\Hook\HookManager'))->toBeFalse();

    $stub->imports()->all()->each(fn ($import) => $imports->add($import));

    expect($imports->all()->has('IBroStudio\ModuleHelper\Install\InstallManager'))->toBeTrue()
        ->and($imports->all()->has('ModuleNamespace\Hook\HookManager'))->toBeTrue();
});
