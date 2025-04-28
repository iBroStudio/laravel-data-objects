<?php

use IBroStudio\DataObjects\ValueObjects\Periods\DayPeriod;

it('can instantiate DayPeriod object value', function () {
    expect(DayPeriod::from(10))
        ->toBeInstanceOf(DayPeriod::class);
});

it('can return DayPeriod object value with unit', function () {
    expect(
        DayPeriod::from(1)->withUnit()
    )->toEqual('day')
        ->and(
            DayPeriod::from(10)->withUnit()
        )->toEqual('10 days');
});
