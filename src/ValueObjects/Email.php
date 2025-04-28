<?php

namespace IBroStudio\DataObjects\ValueObjects;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Email extends ValueObject
{
    public readonly string $username;

    public readonly string $domain;

    public function __construct(mixed $value)
    {
        try {
            [$this->username, $this->domain] = explode('@', $value);
        } catch (\Exception $e) {
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
