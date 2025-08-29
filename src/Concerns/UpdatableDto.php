<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Concerns;

use IBroStudio\DataObjects\Support\DtoComparator;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Transformation\TransformationContext;
use Spatie\LaravelData\Support\Transformation\TransformationContextFactory;

/**
 * @method static from(array $array)
 * @method all()
 * @method array<string, mixed> transform(null|TransformationContextFactory|TransformationContext $transformationContext = null)
 */
trait UpdatableDto
{
    public function updateDto(array $data): self
    {
        return self::from([
            ...$this->transform(
                TransformationContextFactory::create()->withoutValueTransformation()->withoutPropertyNameMapping()
            ),
            ...$data,
        ]);
    }

    public function equalTo(Data $data): bool
    {
        return DtoComparator::areEqual($this, $data);
    }
}
