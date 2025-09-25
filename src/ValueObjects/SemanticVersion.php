<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\ValueObjects;

use IBroStudio\DataObjects\Enums\SemanticVersionEnum;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;
use Illuminate\Validation\ValidationException;

class SemanticVersion extends ValueObject
{
    private int $major;

    private int $minor;

    private int $patch;

    private string $prefix = '';

    public function __construct(mixed $value)
    {
        preg_match(
            '/(?<prefix>v.?)?(?<major>\d+)\.(?<minor>\d+)\.(?<patch>\d+)(?<fourth>.\d+)?/',
            $value,
            $matches
        );

        if (! count($matches)) {
            throw ValidationException::withMessages(['Version is not valid.']);
        }

        $this->major = (int) $matches['major'];
        $this->minor = (int) $matches['minor'];
        $this->patch = (int) $matches['patch'];
        $this->prefix = $matches['prefix'];

        parent::__construct($value);
    }

    public function withoutPrefix(): string
    {
        return Str::after($this->value, $this->prefix);
    }

    public function underscored(): string
    {
        return Str::replace('.', '_', $this->value);
    }

    public function increment(SemanticVersionEnum $segment): static
    {
        $incremented = clone $this;

        if ($segment === SemanticVersionEnum::PATCH) {
            $incremented->patch++;
        } elseif ($segment === SemanticVersionEnum::MINOR) {
            $incremented->minor++;
            $incremented->patch = 0;
        } elseif ($segment === SemanticVersionEnum::MAJOR) {
            $incremented->major++;
            $incremented->minor = 0;
            $incremented->patch = 0;
        }

        return self::from(
            Str::of(
                Arr::join(
                    [$incremented->major, $incremented->minor, $incremented->patch],
                    '.'
                )
            )
                ->when(Str::length($this->prefix), function (Stringable $string) {
                    return $string->prepend($this->prefix);
                })
                ->toString()
        );
    }

    public function branch(): int|string
    {
        return $this->major;
    }

    public function boundary(): static
    {
        $max = clone $this;
        $max->minor = 9999;
        $max->patch = 9999;

        return self::from(
            Str::of(
                Arr::join(
                    [$max->major, $max->minor, $max->patch],
                    '.'
                )
            )
                ->when(Str::length($this->prefix), function (Stringable $string) {
                    return $string->prepend($this->prefix);
                })
                ->toString()
        );
    }
}
