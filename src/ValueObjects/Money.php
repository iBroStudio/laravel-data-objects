<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\ValueObjects;

use IBroStudio\DataObjects\Enums\CurrencyEnum;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

final class Money extends ValueObject
{
    private readonly \Cknow\Money\Money $money;

    public function __construct(mixed $value, ?CurrencyEnum $currency = null)
    {
        $this->money = match (gettype($value)) {
            'integer', 'double' => money((int) ($value * 100), optional($currency)->getAlphaCode()),
            'string' => money_parse($value),
            'object' => $value,
            default => throw ValidationException::withMessages(['Invalid value']),
        };

        parent::__construct($this->money);
    }

    public static function from(mixed ...$values): static
    {
        if (Arr::hasAll($values, ['amount', 'currency'])) {
            return new self(money(...$values));
        }

        // @phpstan-ignore-next-line
        return new self(...$values);
    }

    public function format(?string $locale = null): string
    {
        return Str::squish(
            $this->money->formatByIntl($locale ?? session('lang_country', app()->getLocale()))
        );
    }

    public function formatWithoutDecimal(?string $locale = null): string
    {
        return Str::replaceMatches(
            pattern: '/[\.,][0-9]{2}\s?/',
            replace: '',
            subject: $this->format($locale)
        );
    }

    public function formatWithoutSymbol(): float
    {
        return (float) $this->money->formatByDecimal();
    }

    public function toArray(): array
    {
        return Arr::except($this->money->toArray(), 'formatted');
    }
}
