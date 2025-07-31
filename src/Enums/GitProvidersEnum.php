<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Enums;

use Illuminate\Support\Uri;

enum GitProvidersEnum: string
{
    case BITBUCKET = 'bitbucket';
    case GITHUB = 'github';
    case GITLAB = 'gitlab';

    public function getLabel(): string
    {
        return match ($this) {
            self::BITBUCKET => 'Bitbucket',
            self::GITHUB => 'Github',
            self::GITLAB => 'Gitlab',
        };
    }

    public function getDomain(): string
    {
        return match ($this) {
            self::BITBUCKET => 'bitbucket.org',
            self::GITHUB => 'github.com',
            self::GITLAB => 'gitlab.com',
        };
    }

    public function getUrl(): Uri
    {
        return Uri::of('https://'.$this->getDomain());
    }
}
