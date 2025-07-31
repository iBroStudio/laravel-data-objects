<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Rules;

use Closure;
use IBroStudio\DataObjects\ValueObjects\Phone;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class PhoneRule implements DataAwareRule, ValidationRule
{
    /** @var array<string, mixed> */
    protected $data = [];

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_null($value) && is_null(
            Phone::fromOrNull($value, data_get($this->data, 'phoneCountryIsoCode2'))
        )) {
            $fail(':attribute is not a valid value.');
        }
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }
}
