<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Dto;

use Spatie\LaravelData\Data;
use stdClass;

class VatNumberAuthenticationDto extends Data
{
    public function __construct(
        public string $name,
        public string $vatNumber,
        public string $address,
        public string $countryCode,
    ) {}

    public static function fromViesApi(stdClass $response): self
    {
        return new self(
            name: $response->name,
            vatNumber: $response->vatNumber,
            address: $response->address,
            countryCode: $response->countryCode
        );
    }
}
