<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\ValueObjects\Periods;

use IBroStudio\DataObjects\ValueObjects\IntegerValueObject;

final class YearPeriod extends IntegerValueObject
{
    public function withUnit(): string
    {
        return trans_choice(
            key: 'data-objects::periods.year',
            number: $this->value,
            replace: ['quantity' => $this->value]
        );
    }
}
