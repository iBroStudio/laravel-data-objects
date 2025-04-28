<?php

namespace IBroStudio\DataObjects\ValueObjects\Units;

use IBroStudio\DataObjects\Contracts\UnitValueContract;
use IBroStudio\DataObjects\ValueObjects\IntegerValueObject;

class IntegerUnit extends IntegerValueObject implements UnitValueContract
{
    public function withUnit(): string
    {
        return (string) $this->value;
    }

    public static function unit(): ?string
    {
        return null;
    }
}
