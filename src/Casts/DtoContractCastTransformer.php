<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Casts;

use Illuminate\Support\Arr;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Casts\Uncastable;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;
use Spatie\LaravelData\Support\Transformation\TransformationContext;
use Spatie\LaravelData\Transformers\Transformer;

final class DtoContractCastTransformer implements Cast, Transformer
{
    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): mixed
    {
        $class = Arr::get($value, 'dto_concrete_class');

        if (is_null($class)) {
            return Uncastable::create();
        }

        /** @var class-string<Data> $class */
        return $class::from(Arr::except($value, ['dto_concrete_class']));
    }

    public function transform(DataProperty $property, mixed $value, TransformationContext $context): mixed
    {
        return [
            ...$value->toArray(),
            'dto_concrete_class' => get_class($value),
        ];
    }
}
