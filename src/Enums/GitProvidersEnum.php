<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Enums;

use Illuminate\Support\Uri;

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

    public function getUrl(): Uri
    {
        return Uri::of('https://'.$this->getDomain());
    }
}
