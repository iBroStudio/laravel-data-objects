<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\ValueObjects;

use Carbon\CarbonImmutable;
use IBroStudio\DataObjects\Concerns\HasFileHandler;
use IBroStudio\DataObjects\Enums\DiskDriverEnum;
use IBroStudio\DataObjects\Enums\FileHandlerDriverEnum;
use IBroStudio\DataObjects\ValueObjects\Units\Byte\ByteUnit;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;
use PHPUnit\Runner\FileDoesNotExistException;

final class DataFile extends ValueObject
{
    use HasFileHandler;

    public bool $exists;

    private ?string $content = null;

    public function __construct(
        string $file,
        public readonly string $basename,
        public readonly string $dirname,
        public readonly string $extension,
        public readonly string $filename,
        public Disk|array $disk,
        public ?FileHandlerDriverEnum $fileHandlerDriverEnum,
        private readonly ?array $stubVars = null)
    {
        if (! $disk instanceof Disk) {
            $this->disk = Disk::from(...$disk);
        }

        parent::__construct($file);

        $this->exists = $this->exists();

        if (! $fileHandlerDriverEnum instanceof FileHandlerDriverEnum) {
            $this->fileHandlerDriverEnum = FileHandlerDriverEnum::guessDriverEnum($this);
        }

        $this->loadFileHandler();
    }

    public static function from(mixed ...$values): static
    {
        $values = array_merge($values, pathinfo($values['file']));

        $values = Arr::add($values, 'fileHandlerDriverEnum', FileHandlerDriverEnum::tryFrom($values['extension']));

        // if (! $values['disk'] instanceof Disk && ! Arr::has($values, 'disk.driver')) {
        if (! Arr::has($values, 'disk.driver')) {
            data_set($values, 'disk.driver', DiskDriverEnum::Local);
        }

        if (Arr::has($values, 'directory')) {
            data_set($values, 'disk.root', Arr::pull($values, 'directory'));
        }

        return new self(...$values);
    }

    public function content(bool $refresh = false): string
    {
        $this->throwsIfDoesNotExist();

        if (is_null($this->content) || $refresh) {
            $this->content = Str::of($this->disk->filesystem->get($this->value))
                ->when($this->stubVars, fn (Stringable $content) => $content->replace(
                    search: Arr::map(array_keys($this->stubVars), fn (string $key) => Str::wrap($key, before: '{{ ', after: ' }}')),
                    replace: array_values($this->stubVars)
                ))
                ->value();
        }

        return $this->content;
    }

    public function exists(): bool
    {
        return $this->disk->filesystem->exists($this->value);
    }

    public function visibility(): string
    {
        $this->throwsIfDoesNotExist();

        return $this->disk->filesystem->getVisibility($this->value);
    }

    public function lastModified(): CarbonImmutable
    {
        $this->throwsIfDoesNotExist();

        return CarbonImmutable::createFromTimestamp($this->disk->filesystem->lastModified($this->value));
    }

    public function size(): ByteUnit
    {
        $this->throwsIfDoesNotExist();

        return ByteUnit::from(
            $this->disk->filesystem->size($this->value)
        );
    }

    private function throwsIfDoesNotExist(): void
    {
        if (! $this->exists) {
            throw new FileDoesNotExistException($this->value);
        }
    }
}
