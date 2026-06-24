<?php

declare(strict_types=1);

use IBroStudio\DataObjects\ValueObjects\Money;

it('can instantiate Money object value from integer', function () {
    $money = Money::from(100);

    expect($money)->toBeInstanceOf(Money::class)
        ->and($money->format())->toBe('$100.00');
});

it('can instantiate Money object value from float', function () {
    $money = Money::from(100.50);

    expect($money)->toBeInstanceOf(Money::class)
        ->and($money->format())->toBe('$100.50');
});

it('can instantiate Money object value from string', function () {
    $money = Money::from('$100.50');

    expect($money)->toBeInstanceOf(Money::class)
        ->and($money->format())->toBe('$100.50');
});

it('can format Money object value', function () {
    $money = Money::from(100);

    expect($money->format())->toBe('$100.00');

    session(['lang_country' => 'fr-FR']);

    expect($money->format())->toBe('100,00 $US')
        ->and($money->format('en'))->toBe('$100.00');
});

it('can format Money without decimal', function () {
    $money = Money::from(100);

    expect($money->formatWithoutDecimal())->toBe('$100')
        ->and($money->formatWithoutDecimal('fr'))->toBe('100$US');
});

it('can format Money without symbol', function () {
    $money = Money::from(100);

    expect($money->decimalAmount())->toBe(100.00);
});

it('rounds knife-edge floats to cents instead of truncating', function (float $value, int $cents, float $decimal) {
    $money = Money::from($value);

    expect($money->amount())->toBe($cents)
        ->and($money->decimalAmount())->toBe($decimal);
})->with([
    // float * 100 falls just below the integer cent → (int) used to truncate 1 cent
    'retail price bug' => [17.74, 1774, 17.74],
    'sub-euro knife-edge' => [0.29, 29, 0.29],
]);

it('does not regress floats that already convert exactly', function (float $value, int $cents, float $decimal) {
    $money = Money::from($value);

    expect($money->amount())->toBe($cents)
        ->and($money->decimalAmount())->toBe($decimal);
})->with([
    'lucky value' => [32.74, 3274, 32.74],
    'zero' => [0.0, 0, 0.0],
    'round euros' => [10.00, 1000, 10.00],
    'large amount' => [4050.00, 405000, 4050.00],
]);

it('rounds half a cent to the nearest cent (half up)', function (float $value, int $cents) {
    expect(Money::from($value)->amount())->toBe($cents);
})->with([
    'half cent rounds up' => [0.005, 1],
    'below half cent rounds down' => [0.004, 0],
]);
