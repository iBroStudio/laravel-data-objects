<?php

namespace IBroStudio\DataObjects\ValueObjects;

use Illuminate\Validation\ValidationException;
use Propaganistas\LaravelPhone\PhoneNumber;

class Phone extends ValueObject
{
    public readonly string $national;

    public readonly string $international;

    public readonly string $type;

    public readonly string $country;

    private readonly PhoneNumber $phone;

    public function __construct(mixed $value)
    {
        try {
            $this->phone = new PhoneNumber($value);

            parent::__construct(
                $this->phone->formatE164()
            );

        } catch (\Exception $e) {
            throw ValidationException::withMessages([$e->getMessage()]);
        }

        $this->national = $this->phone->formatNational();
        $this->international = $this->phone->formatInternational();
        $this->type = $this->phone->getType();
        $this->country = $this->phone->getCountry();
    }
}
