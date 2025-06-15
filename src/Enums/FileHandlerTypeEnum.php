<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Enums;

enum FileHandlerTypeEnum: string
{
    case ArrayFile = 'array';
    case ClassFile = 'class';
    // case EnumFile = 'enum';
    // case InterfaceFile = 'interface';
}
