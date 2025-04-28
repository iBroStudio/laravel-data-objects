<?php

namespace IBroStudio\DataObjects\Contracts;

interface UnitValueContract
{
    public function withUnit(): string;

    public static function unit(): ?string;
}
