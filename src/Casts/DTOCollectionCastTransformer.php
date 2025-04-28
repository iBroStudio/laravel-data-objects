<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Casts;

use Illuminate\Support\Collection;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Casts\Uncastable;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

final class DTOCollectionCastTransformer implements Cast
{
    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): mixed
    {
        $type = $property->type->type->findAcceptedTypeForBaseType(Collection::class);

        /** @var class-string<Collection>|null $type */
        return match ($type) {
            null => Uncastable::create(),
            default => collect($value),
        };
    }
}
