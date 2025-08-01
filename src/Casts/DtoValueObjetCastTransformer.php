<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Casts;

use IBroStudio\DataObjects\ValueObjects\Authentication\AuthenticationAbstract;
use IBroStudio\DataObjects\ValueObjects\Authentication\SshAuthentication;
use IBroStudio\DataObjects\ValueObjects\ValueObject;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Casts\IterableItemCast;
use Spatie\LaravelData\Casts\Uncastable;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;
use Spatie\LaravelData\Support\Transformation\TransformationContext;
use Spatie\LaravelData\Transformers\Transformer;

final class DtoValueObjetCastTransformer implements Cast, IterableItemCast, Transformer
{
    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): ValueObject|Uncastable
    {
        return $this->castValue($property->type->type->findAcceptedTypeForBaseType(ValueObject::class), $value);
    }

    public function castIterableItem(DataProperty $property, mixed $value, array $properties, CreationContext $context): ValueObject|Uncastable
    {
        return $this->castValue($property->type->iterableItemType, $value);
    }

    public function transform(DataProperty $property, mixed $value, TransformationContext $context): mixed
    {
        /** @var ValueObject $value */
        return $value->value;
    }

    private function castValue(
        ?string $type,
        mixed $value,
    ): Uncastable|ValueObject {

        /** @var class-string<ValueObject>|null $type */
        return match ($type) {
            null => Uncastable::create(),
            AuthenticationAbstract::class => AuthenticationAbstract::getConcreteAuthenticationValueObject(
                class: AuthenticationAbstract::class,
                value: $value,
            ),
            default => is_array($value) ? $type::from(...$value) : $type::from($value),
        };
    }
}
