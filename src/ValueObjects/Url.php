<?php

namespace IBroStudio\DataObjects\ValueObjects;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Spatie\Url\QueryParameterBag;
use Spatie\Url\Url as ParsedUrl;

class Url extends ValueObject
{
    private ParsedUrl $url;

    public function __construct(string $value)
    {
        parent::__construct($value);

        $this->url = ParsedUrl::fromString($value);
    }

    public function getScheme(): string
    {
        return $this->url->getScheme();
    }

    public function getAuthority(): string
    {
        return $this->url->getAuthority();
    }

    public function getUserInfo(): string
    {
        return $this->url->getUserInfo();
    }

    public function getHost(): string
    {
        return $this->url->getHost();
    }

    public function getPort(): ?int
    {
        return $this->url->getPort();
    }

    public function getPath(): string
    {
        return $this->url->getPath();
    }

    public function getBasename(): string
    {
        return $this->url->getBasename();
    }

    public function getDirname(): string
    {
        return $this->url->getDirname();
    }

    public function getQuery(): string
    {
        return $this->url->getQuery();
    }

    public function getQueryParameter(string $key, mixed $default = null): mixed
    {
        return $this->url->getQueryParameter($key, $default);
    }

    public function hasQueryParameter(string $key): bool
    {
        return $this->url->hasQueryParameter($key);
    }

    /**
     * @return array<string, string>
     */
    public function getAllQueryParameters(): array
    {
        return $this->url->getAllQueryParameters();
    }

    public function withQueryParameter(string $key, string $value): ParsedUrl
    {
        return $this->url->withQueryParameter($key, $value);
    }

    /**
     * @param  array<string, string>  $parameters
     */
    public function withQueryParameters(array $parameters): ParsedUrl
    {
        return $this->url->withQueryParameters($parameters);
    }

    public function withoutQueryParameter(string $key): ParsedUrl
    {
        return $this->url->withoutQueryParameter($key);
    }

    public function withoutQueryParameters(): ParsedUrl
    {
        return $this->url->withoutQueryParameters();
    }

    public function getFragment(): string
    {
        return $this->url->getFragment();
    }

    /**
     * @return array<int, string>
     */
    public function getSegments(): array
    {
        return $this->url->getSegments();
    }

    public function getSegment(int $index, mixed $default = null): mixed
    {
        return $this->url->getSegment($index, $default);
    }

    public function getFirstSegment(): mixed
    {
        return $this->url->getFirstSegment();
    }

    public function getLastSegment(): mixed
    {
        return $this->url->getLastSegment();
    }

    public function withScheme(string $scheme): ParsedUrl
    {
        return $this->url->withScheme($scheme);
    }

    /**
     * @param  array<int, string>  $schemes
     */
    public function withAllowedSchemes(array $schemes): ParsedUrl
    {
        return $this->url->withAllowedSchemes($schemes);
    }

    public function withUserInfo(string $user, ?string $password = null): ParsedUrl
    {
        return $this->url->withUserInfo($user, $password);
    }

    public function withHost(string $host): ParsedUrl
    {
        return $this->url->withHost($host);
    }

    public function withPort(int $port): ParsedUrl
    {
        return $this->url->withPort($port);
    }

    public function withPath(string $path): ParsedUrl
    {
        return $this->url->withPath($path);
    }

    public function withDirname(string $dirname): ParsedUrl
    {
        return $this->url->withDirname($dirname);
    }

    public function withBasename(string $basename): ParsedUrl
    {
        return $this->url->withBasename($basename);
    }

    public function withQuery(QueryParameterBag $query): ParsedUrl
    {
        return $this->url->withQuery($query);
    }

    public function withFragment(string $fragment): ParsedUrl
    {
        return $this->url->withFragment($fragment);
    }

    public function matches(ParsedUrl $url): bool
    {
        return $this->url->matches($url);
    }

    protected function validate(): void
    {
        parent::validate();

        $validator = Validator::make(
            ['url' => $this->value],
            ['url' => 'url'],
        );

        if ($validator->fails()) {
            throw ValidationException::withMessages(['URL is not valid.']);
        }
    }
}
