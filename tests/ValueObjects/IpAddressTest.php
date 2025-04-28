<?php

declare(strict_types=1);

use IBroStudio\DataObjects\ValueObjects\IpAddress;
use Illuminate\Validation\ValidationException;

it('can instantiate IpAddress object value', function () {
    expect(IpAddress::from(fake()->ipv4()))->toBeInstanceOf(IpAddress::class)
        ->and(IpAddress::from(fake()->ipv6()))->toBeInstanceOf(IpAddress::class);
});

it('can validate IpAddress object value', function () {
    IpAddress::from('116.112');
})->throws(ValidationException::class);

it('can return IpAddress object value', function () {
    $ipv4 = fake()->ipv4();
    $ipv6 = fake()->ipv6();

    expect(
        IpAddress::from($ipv4)->value
    )->toEqual($ipv4)
        ->and(
            IpAddress::from($ipv6)->value
        )->toEqual($ipv6);
});
