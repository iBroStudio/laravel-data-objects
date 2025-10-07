<?php

declare(strict_types=1);

use IBroStudio\DataObjects\Enums\CurrencyEnum;
use IBroStudio\DataObjects\ValueObjects\Boolean;
use IBroStudio\DataObjects\ValueObjects\Money;
use Illuminate\Validation\ValidationException;

it('can instantiate Money object value from integer', function () {
    $money = Money::from(100);

    expect($money)->toBeInstanceOf(Money::class)
        ->and($money->value->format())->toBe('$100.00');
});

it('can instantiate Money object value from float', function () {
    $money = Money::from(100.50);

    expect($money)->toBeInstanceOf(Money::class)
        ->and($money->value->format())->toBe('$100.50');
});

it('can instantiate Money object value from string', function () {
    $money = Money::from('$100.50');

    expect($money)->toBeInstanceOf(Money::class)
        ->and($money->value->format())->toBe('$100.50');
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
