<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\ValueObjects;

use Bakame\Laravel\Pdp\Facades\DomainParser;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Pdp;

final class Domain extends ValueObject
{
    public readonly string $subDomain;

    public readonly string $registrableDomain;

    public readonly string $name;

    public readonly string $tld;

    private Pdp\ResolvedDomainName $domain;

    public function __construct(mixed $value)
    {
        $topLevelDomains = DomainParser::getTopLevelDomains();

        $this->domain = $topLevelDomains->resolve($value);

        parent::__construct($value);

        $this->subDomain = $this->domain->subDomain()->toString();
        $this->registrableDomain = $this->domain->registrableDomain()->toString();
        $this->name = $this->domain->secondLevelDomain()->toString();
        $this->tld = $this->domain->suffix()->toString();
    }

    public static function from(mixed ...$values): static
    {
        return parent::from(
            Str::of(current($values))
                ->chopStart(['https://', 'http://'])
                ->before('/')
                ->toString()
        );
    }

    public function addSubDomain(string $subDomain): self
    {
        if (! $this->hasRegistrablePart()) {
            $base = Str::of($this->value)
                ->explode('.')
                ->slice(-2)
                ->implode('.');

            return new self($subDomain.'.'.$base);
        }

        return new self($this->domain->withSubDomain($subDomain)->toString());
    }

    public function addSubSubDomain(string $subSubDomain): self
    {
        if (! $this->hasRegistrablePart()) {
            return new self($subSubDomain.'.'.$this->value);
        }

        return new self(
            $this->domain
                ->withSubDomain(
                    Str::of($this->subDomain)
                        ->prepend('.')
                        ->prepend($subSubDomain)
                        ->value()
                )
                ->toString()
        );
    }

    protected function validate(): void
    {
        parent::validate();

        if (App::environment('local')
            && Str::endsWith($this->value, config('data-objects.ov.domain.local_tlds'))) {

            return;
        }

        if (! $this->domain->suffix()->isICANN() && ! $this->domain->suffix()->isIANA()) {
            throw ValidationException::withMessages(['Domain is not valid.']);
        }
    }

    private function hasRegistrablePart(): bool
    {
        return $this->registrableDomain !== '';
    }
}
