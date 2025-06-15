<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\ValueObjects;

use Exception;
use IBroStudio\DataObjects\Contracts\DiskContract;
use IBroStudio\DataObjects\Contracts\DiskDtoContract;
use IBroStudio\DataObjects\Dto\Disks\FtpDiskDto;
use IBroStudio\DataObjects\Dto\Disks\LocalDiskDto;
use IBroStudio\DataObjects\Dto\Disks\S3DiskDto;
use IBroStudio\DataObjects\Dto\Disks\SftpDiskDto;
use IBroStudio\DataObjects\Enums\DiskDriverEnum;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;

final class Disk extends ValueObject implements DiskContract
{
    public Filesystem $filesystem;

    public DiskDtoContract $properties;

    public function __construct(DiskDtoContract $properties)
    {
        parent::__construct($properties);

        $this->filesystem = Storage::build($properties->toDiskConfig());
    }

    public static function from(mixed ...$values): static
    {
        if (! $values['driver'] instanceof DiskDriverEnum) {
            $values['driver'] = DiskDriverEnum::tryFrom($values['driver']);
        }

        $properties = match ($values['driver']) {
            DiskDriverEnum::Local => LocalDiskDto::from($values),
            DiskDriverEnum::Ftp => FtpDiskDto::from($values),
            DiskDriverEnum::Sftp => SftpDiskDto::from($values),
            DiskDriverEnum::S3 => S3DiskDto::from($values),
            default => throw new Exception('Unknown driver'),
        };

        return new self($properties);
    }

    public function toArray(): array
    {
        return $this->value->toArray();
    }
}
