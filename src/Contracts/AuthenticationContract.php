<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Contracts;

interface AuthenticationContract
{
    public static function from(mixed ...$values): static;

    public function toArray(): array;

    public function toJson(): false|string;
}
