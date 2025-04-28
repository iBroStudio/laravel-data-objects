<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\ValueObjects;

use IBroStudio\DataObjects\DTO\VatNumberAuthenticationDTO;
use IBroStudio\DataObjects\Exceptions\UnauthenticatableGBVatNumberException;
use IBroStudio\DataObjects\Exceptions\UnauthenticatedVatNumberException;
use IBroStudio\DataObjects\Formatters\VatNumberFormatter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Mpociot\VatCalculator\Facades\VatCalculator;

final class VatNumber extends ValueObject
{
    public readonly string $number;

    public readonly string $country;

    public function __construct(mixed $value)
    {
        parent::__construct(
            VatNumberFormatter::format($value)
        );

        $this->number = Str::of($this->value)
            ->substr(2)
            ->value();

        $this->country = Str::of($this->value)
            ->substr(0, 2)
            ->value();
    }

    public function authenticate(): VatNumberAuthenticationDTO
    {
        if ($this->country === 'GB') {
            throw new UnauthenticatableGBVatNumberException;
        }

        $validate = VatCalculator::getVATDetails($this->value);

        if (! $validate || ! $validate->valid) {
            throw new UnauthenticatedVatNumberException;
        }

        return VatNumberAuthenticationDTO::from($validate);
    }

    protected function validate(): void
    {
        if (! VatCalculator::isValidVatNumberFormat($this->value)) {
            throw ValidationException::withMessages(['VAT number is not valid.']);
        }
    }
}
