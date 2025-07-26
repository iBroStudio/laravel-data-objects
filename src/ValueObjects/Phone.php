<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\ValueObjects;

use Exception;
use Illuminate\Validation\ValidationException;
use Propaganistas\LaravelPhone\PhoneNumber;

final class Phone extends ValueObject
{
    public readonly string $national;

    public readonly string $international;

    public readonly string $type;

    public readonly string $country;

    private readonly PhoneNumber $phone;

    public function __construct(mixed $value, ?string $countryIsoCode2 = null)
    {
        try {
            $this->phone = new PhoneNumber($value, $countryIsoCode2);

            parent::__construct(
                $this->phone->formatE164()
            );

        } catch (Exception $e) {
            throw ValidationException::withMessages([$e->getMessage()]);
        }

        $this->national = $this->phone->formatNational();
        $this->international = $this->phone->formatInternational();
        $this->type = $this->phone->getType();
        $this->country = $this->phone->getCountry();
    }
}
