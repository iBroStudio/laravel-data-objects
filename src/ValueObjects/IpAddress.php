<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\ValueObjects;

use Darsyn\IP\Version\Multi;
use Exception;
use Illuminate\Validation\ValidationException;

final class IpAddress extends ValueObject
{
    public function __construct(mixed $value)
    {
        try {
            $multi = Multi::factory($value);
        } catch (Exception $e) {
            throw ValidationException::withMessages([$e->getMessage()]);
        }

        parent::__construct(
            $multi->getProtocolAppropriateAddress()
        );
    }
}
