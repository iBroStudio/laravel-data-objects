<?php

declare(strict_types=1);

use IBroStudio\DataObjects\DataObjectsServiceProvider;
use IBroStudio\DataObjects\ValueObjects\Phone;
use Illuminate\Support\Facades\Config;
use Spatie\LaravelData\Data;

function bootDataObjectsServiceProvider(): void
{
    (new DataObjectsServiceProvider(app()))->packageBooted();
}

function assertDataConfigValuesAreClassStrings(): void
{
    foreach (['transformers', 'casts'] as $key) {
        $values = Config::get("data.{$key}");

        expect($values)->toBeArray();

        foreach ($values as $class => $handler) {
            expect($handler)->toBeString(
                "config('data.{$key}.{$class}') must be a class-string, got ".gettype($handler)
            );
        }
    }
}

it('merges dto config into data config on boot', function (): void {
    assertDataConfigValuesAreClassStrings();

    expect(Config::get('data.transformers.'.Phone::class))->toBeString()
        ->and(Config::get('data.casts.'.Phone::class))->toBeString()
        ->and(Config::get('data.features.cast_and_transform_iterables'))->toBeTrue();
});

it('merges dto config idempotently when the config is cached', function (): void {
    // Simulate `php artisan config:cache`: the dto entries were already baked
    // into `data` when the cache file was generated, so at runtime the provider
    // boots against a config that already contains them.
    Config::set('data', array_replace_recursive(
        Config::get('data-objects.dto'),
        Config::get('data')
    ));

    bootDataObjectsServiceProvider();

    assertDataConfigValuesAreClassStrings();
});

it('resolves a value object through Data::from when the config is cached', function (): void {
    Config::set('data', array_replace_recursive(
        Config::get('data-objects.dto'),
        Config::get('data')
    ));

    bootDataObjectsServiceProvider();

    $data = new class(Phone::from('+33612345678')) extends Data
    {
        public function __construct(public Phone $phone) {}
    };

    expect($data::from(['phone' => '+33612345678'])->phone)
        ->toBeInstanceOf(Phone::class)
        ->and($data->toArray()['phone'])->toBeString();
});
