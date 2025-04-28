<?php

use IBroStudio\DataObjects\ValueObjects\DependenciesJsonFile;
use IBroStudio\DataObjects\ValueObjects\SemanticVersion;
use Illuminate\Validation\ValidationException;

it('can instantiate', function (string $file) {
    expect(
        DependenciesJsonFile::from($file)
    )->toBeInstanceOf(DependenciesJsonFile::class);
})->with([
    __DIR__.'/../Support/composer.json',
    __DIR__.'/../Support/package.json',
]);

it('throws exception when empty dvalue', function () {
    DependenciesJsonFile::from('');
})->throws(ValidationException::class);

it('throws exception when file does not exist', function () {
    DependenciesJsonFile::from('does_not_exist.json');
})->throws(ValidationException::class, 'File not found: does_not_exist.json');

it('can retrieve file version', function (string $file) {
    expect(
        DependenciesJsonFile::from($file)->version()
    )->toBeInstanceOf(SemanticVersion::class);
})->with([
    __DIR__.'/../Support/composer.json',
    __DIR__.'/../Support/package.json',
]);

it('can update package.json version', function (string $file) {
    $version = SemanticVersion::from(fake()->semver());
    expect(
        DependenciesJsonFile::from($file)->version($version)
    )->toEqual($version);
})->with([
    __DIR__.'/../Support/composer.json',
    __DIR__.'/../Support/package.json',
]);

it('can retrieve data', function (string $file) {
    $file = DependenciesJsonFile::from($file);

    expect($file->data())->toBeArray()
        ->and($file->data('authors'))->toMatchArray([['name' => 'yann', 'email' => 'email@example.com']])
        ->and($file->data('authors.0.name'))->toBe('yann');

})->with([
    __DIR__.'/../Support/composer.json',
    __DIR__.'/../Support/package.json',
]);
