<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\ValueObjects\Units;

use IBroStudio\DataObjects\Contracts\UnitValueContract;
use IBroStudio\DataObjects\ValueObjects\IntegerValueObject;

final class EmailUnit extends IntegerValueObject implements UnitValueContract
{
    public static function unit(): string
    {
        return trans_choice(
            key: 'data-objects::units.email',
            number: 2,
            replace: ['quantity' => '']
        );
    }

    public function withUnit(): string
    {
        return trans_choice(
            key: 'data-objects::units.email',
            number: $this->value,
            replace: ['quantity' => $this->value]
        );
    }
}
