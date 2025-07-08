<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\ValueObjects;

use Spatie\TemporaryDirectory\TemporaryDirectory;

/**
 * @property TemporaryDirectory $value
 */
class TempFolder extends ValueObject
{
    public function __construct(
        string|TemporaryDirectory $identifier = '',
        string $location = '',
        bool $deleteWhenDestroyed = true)
    {
        $value = $identifier instanceof TemporaryDirectory
            ? $identifier
            : new TemporaryDirectory()
                ->name($identifier)
                ->location($location)
                ->deleteWhenDestroyed($deleteWhenDestroyed)
                ->create();

        parent::__construct($value);
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

    public function toArray(): array
    {
        return [serialize($this->value)];
    }
}
