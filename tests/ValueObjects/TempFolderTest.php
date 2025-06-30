<?php

declare(strict_types=1);

use IBroStudio\DataObjects\ValueObjects\TempFolder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

it('can instantiate TempFolder object value', function () {
    $directory = TempFolder::make();

    expect($directory)->toBeInstanceOf(TempFolder::class)
        ->and($directory->exists())->toBeTrue();
});

it('can return a path from a TempFolder', function () {
    $directory = TempFolder::make();
    $path = $directory->path('test');

    expect($path)->toBeString()
        ->and(Str::endsWith($path, '/test'))->toBeTrue();
});

it('can return TempFolder name', function () {
    $directory = TempFolder::make();

    expect($directory->getName())->toBeString();
});

it('can delete TempFolder', function () {
    $directory = TempFolder::make();

    expect($directory->delete())->toBeTrue()
        ->and($directory->exists())->toBeFalse();
});

it('can empty a TempFolder', function () {
    $directory = TempFolder::make();
    File::copyDirectory(__DIR__.'/../Support/DataFile', $directory->path());

    expect(count(File::files($directory->path())))->toBeGreaterThan(0);

    $directory->empty();

    expect(count(File::files($directory->path())))->toBe(0);
});
