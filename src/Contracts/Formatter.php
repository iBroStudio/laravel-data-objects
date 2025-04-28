<?php

namespace IBroStudio\DataObjects\Contracts;

interface Formatter
{
    public static function format(string $value): string;
}
