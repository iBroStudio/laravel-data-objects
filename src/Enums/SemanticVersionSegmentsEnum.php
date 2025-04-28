<?php

namespace IBroStudio\DataObjects\Enums;

enum SemanticVersionSegmentsEnum: string
{
    case MAJOR = 'major';
    case MINOR = 'minor';
    case PATCH = 'patch';
}
