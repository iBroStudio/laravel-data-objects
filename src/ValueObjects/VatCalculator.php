<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\ValueObjects;

use IBroStudio\DataObjects\Enums\VatEnum;
use Illuminate\Validation\ValidationException;

final class VatCalculator extends ValueObject
{
    public readonly Money $excluding_tax;
    public readonly Money $including_tax;
    public readonly Money $tax_amount;

    public function __construct(mixed $value, VatEnum $vatEnum)
    {
        parent::__construct($value);

        $this->excluding_tax = $this->value;

        $this->tax_amount = $this->excluding_tax->multiply($vatEnum->getRate());

        $this->including_tax = $this->excluding_tax->add($this->tax_amount);
    }

    protected function validate(): void
    {
        if (! $this->value instanceof Money) {
            throw ValidationException::withMessages(['VatCalculator requires a Money value.']);
        }
    }
}
