<?php

declare(strict_types=1);

use IBroStudio\DataObjects\Enums\CurrenciesEnum;
use Illuminate\Support\Facades\Config;

it('can retrieve label', function () {
    expect(
        CurrenciesEnum::EUR->getLabel()
    )->toBe('Euro');
});

it('can retrieve alpha code', function () {
    expect(
        CurrenciesEnum::EUR->getAlphaCode()
    )->toBe('EUR');
});

it('can retrieve numeric code', function () {
    expect(
        CurrenciesEnum::EUR->getNumericCode()
    )->toBe('978');
});

it('can filter enabled currencies', function () {
    Config::set('app.currencies', ['EUR', 'USD']);

    expect(CurrenciesEnum::enabled())->toMatchArray([CurrenciesEnum::EUR, CurrenciesEnum::USD]);
});
