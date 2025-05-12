<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Enums;

enum DependenciesJsonFilesEnum: string
{
    case COMPOSER = 'composer.json';
    case PACKAGE = 'package.json';
}
