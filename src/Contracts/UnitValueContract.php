<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Contracts;

interface UnitValueContract
{
    public static function unit(): ?string;

    public function withUnit(): string;
}
