<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\ValueObjects\Units;

use IBroStudio\DataObjects\Contracts\UnitValueContract;
use IBroStudio\DataObjects\ValueObjects\IntegerValueObject;

final class IntegerUnit extends IntegerValueObject implements UnitValueContract
{
    public static function unit(): ?string
    {
        return null;
    }

    public function withUnit(): string
    {
        return (string) $this->value;
    }
}
