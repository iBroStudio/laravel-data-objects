<?php

declare(strict_types=1);

use IBroStudio\DataObjects\Enums\CurrencyEnum;
use Illuminate\Support\Facades\Config;

it('can retrieve label', function () {
    expect(
        CurrencyEnum::EUR->getLabel()
    )->toBe('Euro');
});

it('can retrieve alpha code', function () {
    expect(
        CurrencyEnum::EUR->getAlphaCode()
    )->toBe('EUR');
});

it('can retrieve numeric code', function () {
    expect(
        CurrencyEnum::EUR->getNumericCode()
    )->toBe('978');
});

it('can filter enabled currencies', function () {
    Config::set('app.currencies', ['EUR', 'USD']);

    expect(CurrencyEnum::enabled())->toMatchArray([CurrencyEnum::EUR, CurrencyEnum::USD]);
});
