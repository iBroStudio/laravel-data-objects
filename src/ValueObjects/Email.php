<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\ValueObjects;

use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

final class Email extends ValueObject
{
    public readonly string $username;

    public readonly string $domain;

    public function __construct(mixed $value)
    {
        try {
            [$this->username, $this->domain] = explode('@', $value);
        } catch (Exception $e) {
            throw ValidationException::withMessages(['Email is not valid.']);
        }

        parent::__construct($value);
    }

    protected function validate(): void
    {
        parent::validate();

        $validator = Validator::make(
            ['email' => $this->value],
            ['email' => 'email:filter,spoof'],
        );

        if ($validator->fails()) {
            throw ValidationException::withMessages(['Email is not valid.']);
        }
    }
}
