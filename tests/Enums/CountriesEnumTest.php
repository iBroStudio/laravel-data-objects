<?php

declare(strict_types=1);

use IBroStudio\DataObjects\Enums\CountriesEnum;

it('can return CountriesEnum from name', function () {
    expect(
        CountriesEnum::fromName('FR')
    )->toBe(CountriesEnum::FR);
});

it('can return CountriesEnum from lower case name', function () {
    expect(
        CountriesEnum::fromName('fr')
    )->toBe(CountriesEnum::FR);
});
