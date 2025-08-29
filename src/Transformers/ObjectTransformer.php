<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Transformers;

use Spatie\LaravelData\Support\DataProperty;
use Spatie\LaravelData\Support\Transformation\TransformationContext;
use Spatie\LaravelData\Transformers\Transformer;

class ObjectTransformer implements Transformer
{
    public function __construct(protected string $key) {}

    public function transform(DataProperty $property, mixed $value, TransformationContext $context): string
    {
        return $value->{$this->key};
    }
}
