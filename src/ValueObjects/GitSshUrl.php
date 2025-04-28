<?php

namespace IBroStudio\DataObjects\ValueObjects;

use Illuminate\Validation\ValidationException;

class GitSshUrl extends ValueObject
{
    public readonly string $provider;

    public readonly string $username;

    public readonly string $repository;

    public function __construct(mixed $value)
    {
        preg_match(
            '/^git@(?<provider>.*)\..*:(?<username>.*)\/(?<repository>.*)\.git$/',
            $value,
            $matches
        );

        if (! count($matches)) {
            throw ValidationException::withMessages(['Git url is not valid.']);
        }

        $this->provider = $matches['provider'];
        $this->username = $matches['username'];
        $this->repository = $matches['repository'];

        parent::__construct($value);
    }
}
