<?php

namespace IBroStudio\DataObjects;

use Illuminate\Support\Facades\Config;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class DataObjectsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-data-objects')
            ->hasConfigFile()
            ->hasTranslations();
    }

    public function packageBooted(): void
    {
        Config::set('data', array_merge_recursive(
            Config::get('data-objects.dto'),
            Config::get('data') ?? []
        ));

        Config::set('data.features.cast_and_transform_iterables', true);
    }
}
