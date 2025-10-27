<?php

declare(strict_types=1);

use IBroStudio\DataObjects\Enums\VatEnum;
use IBroStudio\DataObjects\ValueObjects\Money;
use IBroStudio\DataObjects\ValueObjects\VatCalculator;
use Illuminate\Validation\ValidationException;

it('can instantiate VatCalculator object value', function () {
    expect(VatCalculator::from(Money::from(100), VatEnum::FR))
        ->toBeInstanceOf(VatCalculator::class);
});

it('can validate VatCalculator', function () {
    VatCalculator::from(100, VatEnum::FR);
})->throws(ValidationException::class);

it('can calculate VAT', function () {
    $vat = VatCalculator::from(Money::from(100), VatEnum::FR);

    expect((int) $vat->excluding_tax->decimalAmount())->toBe(100)
        ->and((int) $vat->tax_amount->decimalAmount())->toBe(20)
        ->and((int) $vat->including_tax->decimalAmount())->toBe(120);
});
