<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\ValueObjects;

use Spatie\TemporaryDirectory\TemporaryDirectory;

/**
 * @property TemporaryDirectory $value
 */
class TempFolder extends ValueObject
{
    public function __construct(string $location = '', bool $deleteWhenDestroyed = true)
    {
        parent::__construct(
            new TemporaryDirectory()
                ->location($location)
                ->deleteWhenDestroyed($deleteWhenDestroyed)
                ->create()
        );
    }

    public function path(string $pathOrFilename = ''): string
    {
        return $this->value->path($pathOrFilename);
    }

    public function empty(): self
    {
        $this->value->empty();

        return $this;
    }

    public function delete(): bool
    {
        return $this->value->delete();
    }

    public function exists(): bool
    {
        return $this->value->exists();
    }

    public function getName(): string
    {
        return $this->value->getName();
    }
}
