<?php

use IBroStudio\DataObjects\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(TestCase::class, RefreshDatabase::class)->in(__DIR__);

function getProperty(object $object, string $property)
{
    return tap((new \ReflectionClass($object))->getProperty($property), function (ReflectionProperty $reflection) {
        $reflection->setAccessible(true);
    })->getValue($object);
}
