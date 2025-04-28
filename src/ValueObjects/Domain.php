<?php

namespace IBroStudio\DataObjects\ValueObjects;

use Bakame\Laravel\Pdp\Facades\DomainParser;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Pdp;

class Domain extends ValueObject
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

    protected function validate(): void
    {
        parent::validate();

        if (! $this->domain->suffix()->isICANN() && ! $this->domain->suffix()->isIANA()) {
            throw ValidationException::withMessages(['Domain is not valid.']);
        }
    }
}
