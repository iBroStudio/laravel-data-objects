<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Enums;

enum DiskDriverEnum: string
{
    case Local = 'local';
    case Ftp = 'ftp';
    case Sftp = 'sftp';
    case S3 = 's3';
}
