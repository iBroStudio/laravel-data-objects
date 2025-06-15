<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Enums;

use IBroStudio\DataObjects\ValueObjects\DataFile;
use Illuminate\Support\Str;

enum FileHandlerDriverEnum: string
{
    case Generic = 'generic';
    case PHP = 'php';

    public static function guessDriverEnum(DataFile $dataFile): self
    {
        $content = $dataFile->content();

        return match (true) {

            Str::startsWith($content, '<?php') => self::PHP,

            default => self::Generic,
        };
    }

    public function getDriver(): string
    {
        return match ($this) {
            self::PHP => $this->value,
            default => 'default',
        };
    }
}
