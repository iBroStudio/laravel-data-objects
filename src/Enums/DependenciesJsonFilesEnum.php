<?php

namespace IBroStudio\DataObjects\Enums;

use IBroStudio\DataObjects\ValueObjects\DependenciesJsonFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

enum DependenciesJsonFilesEnum: string
{
    case COMPOSER = 'composer.json';
    case PACKAGE = 'package.json';
}
