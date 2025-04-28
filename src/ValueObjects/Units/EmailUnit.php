<?php

namespace IBroStudio\DataObjects\ValueObjects\Units;

use IBroStudio\DataObjects\Contracts\UnitValueContract;
use IBroStudio\DataObjects\ValueObjects\IntegerValueObject;

class EmailUnit extends IntegerValueObject implements UnitValueContract
{
    public function withUnit(): string
    {
        return trans_choice(
            key: 'data-objects::units.email',
            number: $this->value,
            replace: ['quantity' => $this->value]
        );
    }

    public static function unit(): ?string
    {
        return trans_choice(
            key: 'data-objects::units.email',
            number: 2,
            replace: ['quantity' => '']
        );
    }
}
