<?php

declare(strict_types=1);

use IBroStudio\DataObjects\Enums\TimeUnitEnum;
use IBroStudio\DataObjects\ValueObjects\TimeDuration;

it('can instantiate TimeDuration object value from string', function () {
    expect(
        TimeDuration::from(fake()->time('H:i:s'))
    )->toBeInstanceOf(TimeDuration::class)
        ->and(
            TimeDuration::from(fake()->time('i:s'))
        )->toBeInstanceOf(TimeDuration::class);

});

it('can instantiate TimeDuration object value from float', function () {
    $duration = TimeDuration::from(3.5, unit: TimeUnitEnum::MINUTES);

    expect($duration)->toBeInstanceOf(TimeDuration::class)
        ->and($duration->value)->toBe('3.5');
});

it('can return formatted Timecode object value', function () {
    $duration = TimeDuration::from(3.5, unit: TimeUnitEnum::MINUTES);

    expect($duration->format())->toBe('3 minutes 30 seconds')
        ->and($duration->format(short: true))->toBe('3m 30s');
});
