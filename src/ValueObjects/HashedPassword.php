<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\ValueObjects;

use Illuminate\Support\Facades\Hash;

final class HashedPassword extends ValueObject
{
    public function __construct(mixed $value)
    {
        parent::__construct(
            Hash::make($value)
        );
    }
}
