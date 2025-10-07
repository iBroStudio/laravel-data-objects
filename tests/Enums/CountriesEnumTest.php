<?php

declare(strict_types=1);

use IBroStudio\DataObjects\Enums\CountryEnum;

it('can return CountriesEnum from name', function () {
    expect(
        CountryEnum::fromName('FR')
    )->toBe(CountryEnum::FR);
});

it('can return CountriesEnum from lower case name', function () {
    expect(
        CountryEnum::fromName('fr')
    )->toBe(CountryEnum::FR);
});
