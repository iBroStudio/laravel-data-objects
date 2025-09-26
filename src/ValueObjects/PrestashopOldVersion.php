<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\ValueObjects;

use IBroStudio\DataObjects\Enums\SemanticVersionEnum;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

final class PrestashopOldVersion extends SemanticVersion
{
    private string $major;

    private int $minor;

    private int $patch;

    public function __construct(mixed $value)
    {
        preg_match(
            '/(?<major>\d+.\d+)\.(?<minor>\d+)\.(?<patch>\d+)/',
            $value,
            $matches
        );

        if (! count($matches)) {
            throw ValidationException::withMessages(['Version is not valid.']);
        }

        $this->major = $matches['major'];
        $this->minor = (int) $matches['minor'];
        $this->patch = (int) $matches['patch'];

        ValueObject::__construct($value);
    }

    public function increment(SemanticVersionEnum $segment): static
    {
        $incremented = clone $this;

        if ($segment === SemanticVersionEnum::PATCH) {
            $incremented->patch++;
        } elseif ($segment === SemanticVersionEnum::MINOR) {
            $incremented->minor++;
            $incremented->patch = 0;
        }

        return self::from(
            Str::of(
                Arr::join(
                    [$incremented->major, $incremented->minor, $incremented->patch],
                    '.'
                )
            )
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
                ->toString()
        );
    }
}
