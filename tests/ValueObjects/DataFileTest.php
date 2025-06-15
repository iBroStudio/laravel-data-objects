<?php

declare(strict_types=1);

use Carbon\CarbonImmutable;
use IBroStudio\DataObjects\Enums\DiskDriverEnum;
use IBroStudio\DataObjects\ValueObjects\DataFile;
use IBroStudio\DataObjects\ValueObjects\Units\Byte\ByteUnit;
use Illuminate\Support\Str;
use PHPUnit\Runner\FileDoesNotExistException;

pest()->group('data-file');

it('can instantiate File object value', function () {
    $file = data_file('TestServiceProvider.php');

    expect($file)
        ->toBeInstanceOf(DataFile::class);
});

it('can check if file exists', function () {
    $file = data_file('TestServiceProvider.php');

    expect($file->exists())
        ->toBeTrue();
});

it('can return file visibility', function () {
    $file = data_file('TestServiceProvider.php');

    expect($file->visibility())
        ->toBe('public');
});

it('throws exception if file does not exist', function () {
    data_file('unknown.php')->visibility();
})->throws(FileDoesNotExistException::class);

it('can return file last modification date', function () {
    $file = data_file('TestServiceProvider.php');

    expect($file->lastModified())
        ->toBeInstanceOf(CarbonImmutable::class);
});

it('can return file size', function () {
    $file = data_file('TestServiceProvider.php');

    expect($file->size())
        ->toBeInstanceOf(ByteUnit::class);
});

it('can return file content', function () {
    $file = data_file('DataFile/content.txt');

    expect(Str::squish($file->content()))
        ->toBe('test');
});
