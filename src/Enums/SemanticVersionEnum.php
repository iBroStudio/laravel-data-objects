<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Enums;

enum SemanticVersionEnum: string
{
    case MAJOR = 'major';
    case MINOR = 'minor';
    case PATCH = 'patch';
}
