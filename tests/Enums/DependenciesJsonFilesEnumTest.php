<?php

declare(strict_types=1);

use IBroStudio\DataObjects\ValueObjects\DependenciesJsonFile;
use Illuminate\Support\Collection;

it('can return files list with path', function () {
    $files = DependenciesJsonFile::collectionFromPath(__DIR__.'/../Support');

    expect($files)->toBeInstanceOf(Collection::class)
        ->and($files->first())->toBeInstanceOf(DependenciesJsonFile::class);
});
