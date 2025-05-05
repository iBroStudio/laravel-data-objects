<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Enums;

enum GitProvidersEnum: string
{
    case GITHUB = 'github';

    public function getLabel(): string
    {
        return match ($this) {
            self::GITHUB => 'Github',
        };
    }

    public function getDomain(): string
    {
        return match ($this) {
            self::GITHUB => 'github.com',
        };
    }
}
