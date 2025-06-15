<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Tests\Support\DataFile;

class FakeClass
{
    public string $stringProp = 'test';

    public int $intProp = 21;

    public float $floatProp = 2.1;

    public array $arrayProp = ['value-1', 'value-2'];

    public array $indexedArrayProp = ['test-1' => 'value-1', 'test-2' => 'value-2'];

    public array $nestedArrayProp = ['test-1' => ['nested-value-1'], 'test-2' => ['nested-key-2' => 'nested-value-2']];

    public string $classStringProp = \Carbon\CarbonImmutable::class;

    public array $classStringArrayValueProp = [\Carbon\CarbonImmutable::class];

    public array $classStringArrayIndexProp = [\Carbon\CarbonImmutable::class => 'value-1'];

    protected function testMethod(): bool
    {
        return true;
    }
}
