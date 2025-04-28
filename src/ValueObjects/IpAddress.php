<?php

namespace IBroStudio\DataObjects\ValueObjects;

use Darsyn\IP\Version\Multi;
use Illuminate\Validation\ValidationException;

class IpAddress extends ValueObject
{
    public function __construct(mixed $value)
    {
        try {
            $multi = Multi::factory($value);
        } catch (\Exception $e) {
            throw ValidationException::withMessages([$e->getMessage()]);
        }

        parent::__construct(
            $multi->getProtocolAppropriateAddress()
        );
    }
}
