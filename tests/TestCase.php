<?php

namespace IBroStudio\DataObjects\Tests;

use Bakame\Laravel\Pdp;
use IBroStudio\DataObjects\DataObjectsServiceProvider;
use IBroStudio\DataObjects\Tests\Support\TestServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;
use Mpociot\VatCalculator\VatCalculatorServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\LaravelData\LaravelDataServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'IBroStudio\\DataObjects\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            DataObjectsServiceProvider::class,
            LaravelDataServiceProvider::class,
            Pdp\ServiceProvider::class,
            VatCalculatorServiceProvider::class,
            TestServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
         foreach (\Illuminate\Support\Facades\File::allFiles(__DIR__ . '/database/migrations') as $migration) {
            (include $migration->getRealPath())->up();
         }
         */

        foreach (File::allFiles(__DIR__.'/Support/Database/Migrations') as $migration) {
            (include $migration->getRealPath())->up();
        }
    }
}
