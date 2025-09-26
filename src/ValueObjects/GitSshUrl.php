<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\ValueObjects;

use IBroStudio\DataObjects\Enums\GitProvidersEnum;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

final class GitSshUrl extends ValueObject
{
    public readonly GitProvidersEnum $provider;

    public readonly string $username;

    public readonly string $repository;

    public readonly string $url;

    public readonly ?string $branch;

    public function __construct(mixed $value)
    {
        preg_match(
            '/^git@(?<provider>.*)\..*:(?<username>.*)\/(?<repository>.*)\.git;?(?<branch>.*)$/',
            $value,
            $matches
        );

        if (! count($matches)) {
            throw ValidationException::withMessages(['Git url is not valid.']);
        }

        $this->provider = GitProvidersEnum::tryFrom($matches['provider']);
        $this->username = $matches['username'];
        $this->repository = $matches['repository'];
        $this->branch = $matches['branch'];
        $this->url = Str::before($value, ';');

        parent::__construct($value);
    }

    public static function build(GitProvidersEnum $provider, string $username, string $repository): static
    {
        return self::from(
            Str::of('git@')
                ->append($provider->getDomain())
                ->append(':')
                ->append($username)
                ->append('/')
                ->append($repository)
                ->append('.git')
                ->value()
        );
    }

    public function toHttp(): string
    {
        return $this->provider
            ->getUrl()
            ->withPath($this->username.'/'.$this->repository)
            ->value();
    }

    public function branch(string $branch): static
    {
        return self::from(
            Str::of($this->value)
                ->append(';')
                ->append($branch)
                ->value()
        );
    }
}
