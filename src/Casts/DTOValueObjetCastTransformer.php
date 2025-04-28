<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Casts;

use IBroStudio\DataObjects\ValueObjects\Authentication\Authentication;
use IBroStudio\DataObjects\ValueObjects\ValueObject;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Casts\IterableItemCast;
use Spatie\LaravelData\Casts\Uncastable;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

final class DTOValueObjetCastTransformer implements Cast, IterableItemCast
{
    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): ValueObject|Uncastable
    {
        return $this->castValue($property->type->type->findAcceptedTypeForBaseType(ValueObject::class), $value);
    }

    public function castIterableItem(DataProperty $property, mixed $value, array $properties, CreationContext $context): ValueObject|Uncastable
    {
        return $this->castValue($property->type->iterableItemType, $value);
    }

    private function castValue(
        ?string $type,
        mixed $value,
    ): Uncastable|null|ValueObject {

        /** @var class-string<ValueObject>|null $type */
        return match ($type) {
            null => Uncastable::create(),
            Authentication::class => Authentication::getConcreteAuthenticationValueObject(
                class: Authentication::class,
                value: $value,
            ),
            default => is_array($value) ? $type::from(...$value) : $type::from($value),
        };
    }
}
