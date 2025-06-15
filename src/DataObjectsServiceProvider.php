<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects;

use IBroStudio\DataObjects\Managers\FileHandlerManager;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Config;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

final class DataObjectsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-data-objects')
            ->hasConfigFile()
            ->hasTranslations();
    }

    public function packageRegistered()
    {
        $this->app->singleton(
            abstract: FileHandlerManager::class,
            concrete: fn (Application $app) => new FileHandlerManager($app),
        );
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
