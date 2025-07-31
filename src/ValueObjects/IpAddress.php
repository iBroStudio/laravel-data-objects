<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\ValueObjects;

use Darsyn\IP\Version\Multi;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

final class IpAddress extends ValueObject
{
    public function __construct(mixed $value)
    {
        $validator = Validator::make(
            ['ip' => $value],
            ['ip' => 'ip']
        );

        if ($validator->stopOnFirstFailure()->fails()) {
            throw ValidationException::withMessages(['This is not a valid IP address.']);
        }

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
