<?php

namespace IBroStudio\DataObjects\Enums;

enum TimeUnitEnum: string
{
    case SECONDS = 'seconds';
    case MINUTES = 'minutes';
    case HOURS = 'hours';
    case DAYS = 'days';
    case WEEKS = 'weeks';
    case MONTHS = 'months';
    case YEARS = 'years';
}
