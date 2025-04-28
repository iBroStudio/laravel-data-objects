<?php

use IBroStudio\DataObjects\ValueObjects\Periods\MonthPeriod;

it('can instantiate MonthPeriod object value', function () {
    expect(MonthPeriod::from(10))
        ->toBeInstanceOf(MonthPeriod::class);
});

it('can return DayPeriod object value with unit', function () {
    expect(
        MonthPeriod::from(1)->withUnit()
    )->toEqual('month')
        ->and(
            MonthPeriod::from(10)->withUnit()
        )->toEqual('10 months');
});
