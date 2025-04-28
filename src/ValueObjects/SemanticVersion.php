<?php

namespace IBroStudio\DataObjects\ValueObjects;

use IBroStudio\DataObjects\Enums\SemanticVersionSegmentsEnum;
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
            '/(?<prefix>v.?)?(?<major>\d+)\.(?<minor>\d+)\.(?<patch>\d+)/',
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

    public function increment(SemanticVersionSegmentsEnum $segment): static
    {
        $incremented = clone $this;

        if ($segment === SemanticVersionSegmentsEnum::PATCH) {
            $incremented->patch++;
        } elseif ($segment === SemanticVersionSegmentsEnum::MINOR) {
            $incremented->minor++;
            $incremented->patch = 0;
        } elseif ($segment === SemanticVersionSegmentsEnum::MAJOR) {
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
}
