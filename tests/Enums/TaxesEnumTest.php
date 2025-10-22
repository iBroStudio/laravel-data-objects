<?php

declare(strict_types=1);

use IBroStudio\DataObjects\Enums\VatEnum;

it('can return Tax rate', function () {
    expect(VatEnum::NO_VAT->getRate())->toBe(0.0)
        ->and(VatEnum::AUTOLIQUITATION->getRate())->toBe(0.0)
        ->and(VatEnum::FR->getRate())->toBe(0.2);
});

it('can return Tax label', function () {
    expect(VatEnum::NO_VAT->getLabel())->toBe('VAT 0%')
        ->and(VatEnum::AUTOLIQUITATION->getLabel())->toBe('VAT 0%')
        ->and(VatEnum::FR->getLabel())->toBe('VAT 20%');
});

it('can return Tax legal notice', function () {
    expect(VatEnum::NO_VAT->getLegalNotice())->toBe('VAT not applicable according to article 259-1 of the French Tax General Code.')
        ->and(VatEnum::AUTOLIQUITATION->getLegalNotice())->toBe('Reverse charge of VAT - Article 283-2 of the French Tax General Code.')
        ->and(VatEnum::FR->getLegalNotice())->toBeNull();
});
