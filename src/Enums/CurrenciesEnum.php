<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Enums;

enum CurrenciesEnum: string
{
    case AED = 'United Arab Emirates dirham';
    case AFN = 'Afghan afghani';
    case ALL = 'Albanian lek';
    case AMD = 'Armenian dram';
    case ANG = 'Netherlands Antillean guilder';
    case AOA = 'Angolan kwanza';
    case ARS = 'Argentine peso';
    case AUD = 'Australian dollar';
    case AWG = 'Aruban florin';
    case AZN = 'Azerbaijani manat';
    case BAM = 'Bosnia and Herzegovina convertible mark';
    case BBD = 'Barbados dollar';
    case BDT = 'Bangladeshi taka';
    case BGN = 'Bulgarian lev';
    case BHD = 'Bahraini dinar';
    case BIF = 'Burundian franc';
    case BMD = 'Bermudian dollar';
    case BND = 'Brunei dollar';
    case BOB = 'Boliviano';
    case BOV = 'Bolivian Mvdol (funds code)';
    case BRL = 'Brazilian real';
    case BSD = 'Bahamian dollar';
    case BTN = 'Bhutanese ngultrum';
    case BWP = 'Botswana pula';
    case BYR = 'Belarusian ruble';
    case BZD = 'Belize dollar';
    case CAD = 'Canadian dollar';
    case CDF = 'Congolese franc';
    case CHE = 'WIR Euro (complementary currency)';
    case CHF = 'Swiss franc';
    case CHW = 'WIR Franc (complementary currency)';
    case CLF = 'Unidad de Fomento (funds code)';
    case CLP = 'Chilean peso';
    case CNY = 'Chinese yuan';
    case COP = 'Colombian peso';
    case COU = 'Unidad de Valor Real';
    case CRC = 'Costa Rican colon';
    case CUP = 'Cuban peso';
    case CVE = 'Cape Verde escudo';
    case CZK = 'Czech koruna';
    case DJF = 'Djiboutian franc';
    case DKK = 'Danish krone';
    case DOP = 'Dominican peso';
    case DZD = 'Algerian dinar';
    case EGP = 'Egyptian pound';
    case ERN = 'Eritrean nakfa';
    case ETB = 'Ethiopian birr';
    case EUR = 'Euro';
    case FJD = 'Fiji dollar';
    case FKP = 'Falkland Islands pound';
    case GBP = 'Pound sterling';
    case GEL = 'Georgian lari';
    case GHS = 'Ghanaian cedi';
    case GIP = 'Gibraltar pound';
    case GMD = 'Gambian dalasi';
    case GNF = 'Guinean franc';
    case GTQ = 'Guatemalan quetzal';
    case GYD = 'Guyanese dollar';
    case HKD = 'Hong Kong dollar';
    case HNL = 'Honduran lempira';
    case HTG = 'Haitian gourde';
    case HUF = 'Hungarian forint';
    case IDR = 'Indonesian rupiah';
    case ILS = 'Israeli new shekel';
    case INR = 'Indian rupee';
    case IQD = 'Iraqi dinar';
    case IRR = 'Iranian rial';
    case ISK = 'Icelandic króna';
    case JMD = 'Jamaican dollar';
    case JOD = 'Jordanian dinar';
    case JPY = 'Japanese yen';
    case KES = 'Kenyan shilling';
    case KGS = 'Kyrgyzstani som';
    case KHR = 'Cambodian riel';
    case KMF = 'Comoro franc';
    case KPW = 'North Korean won';
    case KRW = 'South Korean won';
    case KWD = 'Kuwaiti dinar';
    case KYD = 'Cayman Islands dollar';
    case KZT = 'Kazakhstani tenge';
    case LAK = 'Lao kip';
    case LBP = 'Lebanese pound';
    case LKR = 'Sri Lankan rupee';
    case LRD = 'Liberian dollar';
    case LSL = 'Lesotho loti';
    case LYD = 'Libyan dinar';
    case MAD = 'Moroccan dirham';
    case MDL = 'Moldovan leu';
    case MGA = 'Malagasy ariary';
    case MKD = 'Macedonian denar';
    case MMK = 'Myanma kyat';
    case MNT = 'Mongolian tugrik';
    case MOP = 'Macanese pataca';
    case MRU = 'Mauritanian ouguiya';
    case MUR = 'Mauritian rupee';
    case MVR = 'Maldivian rufiyaa';
    case MWK = 'Malawian kwacha';
    case MXN = 'Mexican peso';
    case MXV = 'Mexican Unidad de Inversion (UDI) (funds code)';
    case MYR = 'Malaysian ringgit';
    case MZN = 'Mozambican metical';
    case NAD = 'Namibian dollar';
    case NGN = 'Nigerian naira';
    case NIO = 'Nicaraguan córdoba';
    case NOK = 'Norwegian krone';
    case NPR = 'Nepalese rupee';
    case NZD = 'New Zealand dollar';
    case OMR = 'Omani rial';
    case PAB = 'Panamanian balboa';
    case PEN = 'Peruvian nuevo sol';
    case PGK = 'Papua New Guinean kina';
    case PHP = 'Philippine peso';
    case PKR = 'Pakistani rupee';
    case PLN = 'Polish złoty';
    case PYG = 'Paraguayan guaraní';
    case QAR = 'Qatari riyal';
    case RON = 'Romanian new leu';
    case RSD = 'Serbian dinar';
    case RUB = 'Russian rouble';
    case RWF = 'Rwandan franc';
    case SAR = 'Saudi riyal';
    case SBD = 'Solomon Islands dollar';
    case SCR = 'Seychelles rupee';
    case SDG = 'Sudanese pound';
    case SEK = 'Swedish krona/kronor';
    case SGD = 'Singapore dollar';
    case SHP = 'Saint Helena pound';
    case SLE = 'Sierra Leonean leone';
    case SOS = 'Somali shilling';
    case SRD = 'Surinamese dollar';
    case SSP = 'South Sudanese pound';
    case STN = 'São Tomé and Príncipe dobra';
    case SVC = 'Salvadoran colón';
    case SYP = 'Syrian pound';
    case SZL = 'Swazi lilangeni';
    case THB = 'Thai baht';
    case TJS = 'Tajikistani somoni';
    case TMT = 'Turkmenistani manat';
    case TND = 'Tunisian dinar';
    case TOP = 'Tongan paʻanga';
    case TRY = 'Turkish lira';
    case TTD = 'Trinidad and Tobago dollar';
    case TWD = 'New Taiwan dollar';
    case TZS = 'Tanzanian shilling';
    case UAH = 'Ukrainian hryvnia';
    case UGX = 'Ugandan shilling';
    case USD = 'United States dollar';
    case UYU = 'Uruguayan peso';
    case UZS = 'Uzbekistan som';
    case VES = 'Venezuelan sovereign bolívar';
    case VND = 'Vietnamese dong';
    case VUV = 'Vanuatu vatu';
    case WST = 'Samoan tala';
    case XAF = 'CFA franc BEAC';
    case XCD = 'East Caribbean dollar';
    case XOF = 'CFA franc BCEAO';
    case XPF = 'CFP franc';
    case YER = 'Yemeni rial';
    case ZAR = 'South African rand';
    case ZMW = 'Zambian kwacha';

    public static function enabled(): array
    {
        return array_values(
            collect(self::cases())
                ->filter(function ($currency) {
                    return in_array($currency->name, config('app.currencies', []));
                })
                ->toArray()
        );
    }

    public function getLabel(): string
    {
        return $this->value;
    }

    public function getAlphaCode(): string
    {
        return $this->name;
    }

    public function getNumericCode(): string
    {
        return match ($this) {
            self::AED => '784',
            self::AFN => '971',
            self::ALL => '008',
            self::AMD => '051',
            self::ANG => '532',
            self::AOA => '973',
            self::ARS => '032',
            self::AUD => '036',
            self::AWG => '533',
            self::AZN => '944',
            self::BAM => '977',
            self::BBD => '052',
            self::BDT => '050',
            self::BGN => '975',
            self::BHD => '048',
            self::BIF => '108',
            self::BMD => '060',
            self::BND => '096',
            self::BOB => '068',
            self::BOV => '984',
            self::BRL => '986',
            self::BSD => '044',
            self::BTN => '064',
            self::BWP => '072',
            self::BYR => '933',
            self::BZD => '084',
            self::CAD => '124',
            self::CDF => '976',
            self::CHE => '947',
            self::CHF => '756',
            self::CHW => '948',
            self::CLF => '990',
            self::CLP => '152',
            self::CNY => '156',
            self::COP => '170',
            self::COU => '970',
            self::CRC => '188',
            self::CUP => '192',
            self::CVE => '132',
            self::CZK => '203',
            self::DJF => '262',
            self::DKK => '208',
            self::DOP => '214',
            self::DZD => '012',
            self::EGP => '818',
            self::ERN => '232',
            self::ETB => '230',
            self::EUR => '978',
            self::FJD => '242',
            self::FKP => '238',
            self::GBP => '826',
            self::GEL => '981',
            self::GHS => '936',
            self::GIP => '292',
            self::GMD => '270',
            self::GNF => '324',
            self::GTQ => '320',
            self::GYD => '328',
            self::HKD => '344',
            self::HNL => '340',
            self::HTG => '332',
            self::HUF => '348',
            self::IDR => '360',
            self::ILS => '376',
            self::INR => '356',
            self::IQD => '368',
            self::IRR => '364',
            self::ISK => '352',
            self::JMD => '388',
            self::JOD => '400',
            self::JPY => '392',
            self::KES => '404',
            self::KGS => '417',
            self::KHR => '116',
            self::KMF => '174',
            self::KPW => '408',
            self::KRW => '410',
            self::KWD => '414',
            self::KYD => '136',
            self::KZT => '398',
            self::LAK => '418',
            self::LBP => '422',
            self::LKR => '144',
            self::LRD => '430',
            self::LSL => '426',
            self::LYD => '436',
            self::MAD => '504',
            self::MDL => '498',
            self::MGA => '969',
            self::MKD => '807',
            self::MMK => '104',
            self::MNT => '496',
            self::MOP => '446',
            self::MRU => '929',
            self::MUR => '480',
            self::MVR => '462',
            self::MWK => '454',
            self::MXN => '484',
            self::MXV => '979',
            self::MYR => '458',
            self::MZN => '943',
            self::NAD => '516',
            self::NGN => '566',
            self::NIO => '558',
            self::NOK => '578',
            self::NPR => '524',
            self::NZD => '554',
            self::OMR => '512',
            self::PAB => '590',
            self::PEN => '604',
            self::PGK => '598',
            self::PHP => '608',
            self::PKR => '586',
            self::PLN => '985',
            self::PYG => '600',
            self::QAR => '634',
            self::RON => '946',
            self::RSD => '941',
            self::RUB => '643',
            self::RWF => '646',
            self::SAR => '682',
            self::SBD => '090',
            self::SCR => '690',
            self::SDG => '938',
            self::SEK => '752',
            self::SGD => '702',
            self::SHP => '654',
            self::SLE => '925',
            self::SOS => '706',
            self::SRD => '968',
            self::SSP => '728',
            self::STN => '930',
            self::SVC => '222',
            self::SYP => '760',
            self::SZL => '748',
            self::THB => '764',
            self::TJS => '972',
            self::TMT => '934',
            self::TND => '788',
            self::TOP => '776',
            self::TRY => '949',
            self::TTD => '780',
            self::TWD => '901',
            self::TZS => '834',
            self::UAH => '980',
            self::UGX => '800',
            self::USD => '840',
            self::UYU => '858',
            self::UZS => '860',
            self::VES => '928',
            self::VND => '704',
            self::VUV => '548',
            self::WST => '882',
            self::XAF => '950',
            self::XCD => '951',
            self::XOF => '952',
            self::XPF => '953',
            self::YER => '886',
            self::ZAR => '710',
            self::ZMW => '967',
        };
    }
}
