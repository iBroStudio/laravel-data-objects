<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\ValueObjects\Units\Byte;

use ByteUnits\Metric;
use IBroStudio\DataObjects\Contracts\UnitValueContract;
use IBroStudio\DataObjects\Enums\ByteUnitEnum;

final class MegaByteUnit extends ByteUnit implements UnitValueContract
{
    public static function from(mixed ...$values): static
    {
        return parent::from(Metric::megabytes(current($values)));
    }

    public static function unit(): ?string
    {
        return ByteUnitEnum::MB->getLabel();
    }
}
