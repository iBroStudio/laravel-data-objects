<?php

namespace IBroStudio\DataObjects\Contracts;

use ReflectionClass;
use ReflectionProperty;

interface Converter
{
    public function validate(ReflectionClass $reflection, ReflectionProperty $property): bool;

    public function convert(ReflectionClass $reflection, ReflectionProperty $property, mixed $data): mixed;
}
