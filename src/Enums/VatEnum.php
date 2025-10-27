<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Enums;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Number;

enum VatEnum: string
{
    case NO_VAT = 'no_tax';
    case AUTOLIQUITATION = 'autoliquidation';
    case AT = 'AT'; // Austria
    case BE = 'BE'; // Belgium
    case BG = 'BG'; // Bulgaria
    case CY = 'CY'; // Cyprus
    case CZ = 'CZ'; // Czech Republic
    case DE = 'DE'; // Germany
    case DK = 'DK'; // Denmark
    case EE = 'EE'; // Estonia
    case ES = 'ES'; // Spain
    case FI = 'FI'; // Finland
    case FR = 'FR'; // France
    case GP = 'GP'; // Guadeloupe (France)
    case GR = 'GR'; // Greece
    case HR = 'HR'; // Croatia
    case HU = 'HU'; // Hungary
    case IE = 'IE'; // Ireland
    case IT = 'IT'; // Italy
    case LT = 'LT'; // Lithuania
    case LU = 'LU'; // Luxembourg
    case LV = 'LV'; // Latvia
    case MC = 'MC'; // Monaco France
    case MT = 'MT'; // Malta
    case MQ = 'MQ'; // Martinique (France)
    case NL = 'NL'; // Netherlands
    case PL = 'PL'; // Austria
    case PT = 'PT'; // Portugal
    case RE = 'RE'; // Reunion (France)
    case RO = 'RO'; // Romania
    case SE = 'SE'; // Sweden
    case SI = 'SI'; // Slovenia
    case SK = 'SK'; // Slovakia

    public function getRate(): float
    {
        return match ($this) {
            self::NO_VAT => 0,
            self::AUTOLIQUITATION => 0,
            self::AT => 0.2,// Austria
            self::BE => 0.21,// Belgium
            self::BG => 0.2,// Bulgaria
            self::CY => 0.19,// Cyprus
            self::CZ => 0.21,// Czech Republic
            self::DE => 0.19,// Germany
            self::DK => 0.25,// Denmark
            self::EE => 0.24,// Estonia
            self::ES => 0.21,// Spain
            self::FI => 0.255,// Finland
            self::FR => 0.2,// France
            self::GP => 0.085,// Guadeloupe (France)
            self::GR => 0.24,// Greece
            self::HR => 0.25,// Croatia
            self::HU => 0.27,// Hungary
            self::IE => 0.23,// Ireland
            self::IT => 0.22,// Italy
            self::LT => 0.21,// Lithuania
            self::LU => 0.17,// Luxembourg
            self::LV => 0.21,// Latvia
            self::MC => 0.2,// Monaco France
            self::MT => 0.18,// Malta
            self::MQ => 0.085,// Martinique (France)
            self::NL => 0.21,// Netherlands
            self::PL => 0.23,// Poland
            self::PT => 0.23,// Portugal
            self::RE => 0.085,// Reunion (France)
            self::RO => 0.21,// Romania
            self::SE => 0.25,// Sweden
            self::SI => 0.22,// Slovenia
            self::SK => 0.23,// Slovakia
        };
    }

    public function getLabel(): string
    {
        return __('VAT :tax_label', ['tax_label' => Number::percentage($this->getRate() * 100, maxPrecision: 2, locale: App::currentLocale())]);
    }

    public function getLegalNotice(): ?string
    {
        return match ($this) {
            self::NO_VAT => __('VAT not applicable according to article 259-1 of the French Tax General Code.'),
            // TVA non applicable — Article 259-1 du CGI.
            self::AUTOLIQUITATION => __('Reverse charge of VAT - Article 283-2 of the French Tax General Code.'),
            // Autoliquidation de la TVA - Article 283-2 du Code général des impôts.
            default => null,
        };
    }
}
