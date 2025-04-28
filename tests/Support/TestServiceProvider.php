<?php

namespace IBroStudio\DataObjects\Tests\Support;

use Faker\Factory;
use Faker\Generator;
use IBroStudio\DataObjects\Tests\Support\Faker\DataObjectsFakeProvider;
use Illuminate\Support\ServiceProvider;

class TestServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        if (! $this->app->environment(['local', 'testing'])) {
            return;
        }

        $this->app->singleton(
            abstract: Generator::class,
            concrete: function (): Generator {
                $factory = Factory::create();

                $factory->addProvider(new DataObjectsFakeProvider($factory));

                return $factory;
            }
        );

        $this->app->bind(
            abstract: Generator::class.':'.config('app.faker_locale'),
            concrete: Generator::class
        );
    }
}
