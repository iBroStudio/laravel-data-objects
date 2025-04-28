<?php

use IBroStudio\DataObjects\ValueObjects\Periods\YearPeriod;

it('can instantiate YearPeriod object value', function () {
    expect(YearPeriod::from(10))
        ->toBeInstanceOf(YearPeriod::class);
});

it('can return DayPeriod object value with unit', function () {
    expect(
        YearPeriod::from(1)->withUnit()
    )->toEqual('year')
        ->and(
            YearPeriod::from(10)->withUnit()
        )->toEqual('10 years');
});
