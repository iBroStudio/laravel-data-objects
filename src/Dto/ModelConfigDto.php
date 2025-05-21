<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Dto;

use IBroStudio\DataObjects\Attributes\EloquentCast;
use IBroStudio\DataObjects\Contracts\ModelConfigDTOContract;
use IBroStudio\DataObjects\ValueObjects\ClassString;
use Illuminate\Support\Collection;
use ReflectionClass;
use ReflectionProperty;
use Spatie\LaravelData\Data;

abstract class ModelConfigDto extends Data implements ModelConfigDTOContract
{
    final public function getCasts(): Collection
    {
        $reflectionClass = new ReflectionClass($this);

        return collect($reflectionClass->getProperties(ReflectionProperty::IS_PUBLIC))
            ->filter(function (ReflectionProperty $property) {
                return count($property->getAttributes(EloquentCast::class)) > 0;
            })
            ->mapWithKeys(function (ReflectionProperty $property) {
                /** @var ClassString $cast */
                $cast = $property->getValue($this);

                return property_exists($cast, 'value') ? [$property->getName() => $cast->value] : [];
            });
    }
}
