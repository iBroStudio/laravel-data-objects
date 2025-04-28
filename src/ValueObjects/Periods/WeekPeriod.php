<?php

namespace IBroStudio\DataObjects\ValueObjects\Periods;

use IBroStudio\DataObjects\ValueObjects\IntegerValueObject;

class WeekPeriod extends IntegerValueObject
{
    public function withUnit(): string
    {
        return trans_choice(
            key: 'data-objects::periods.week',
            number: $this->value,
            replace: ['quantity' => $this->value]
        );
    }
}
