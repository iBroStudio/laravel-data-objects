<?php

declare(strict_types=1);

use IBroStudio\DataObjects\Enums\SemanticVersionEnum;
use IBroStudio\DataObjects\ValueObjects\PrestashopOldVersion;
use IBroStudio\DataObjects\ValueObjects\SemanticVersion;
use Illuminate\Validation\ValidationException;

it('can instantiate PrestashopOldVersion object', function () {
    $version = PrestashopOldVersion::from('1.6.1.2');

    expect($version)->toBeInstanceOf(PrestashopOldVersion::class)
        ->and(invade($version)->major)->toEqual('1.6')
        ->and(invade($version)->minor)->toEqual('1')
        ->and(invade($version)->patch)->toEqual('2');

});

it('can return PrestashopOldVersion object value', function () {
    $version = '1.6.1.2';

    expect(
        PrestashopOldVersion::from($version)->value
    )->toEqual($version);
});

it('can validate PrestashopOldVersion object value', function () {
    PrestashopOldVersion::from('invalid version');
})->throws(ValidationException::class);

it('can increment PrestashopOldVersion minor segment', function () {
    expect(
        PrestashopOldVersion::from('1.6.1.2')
            ->increment(SemanticVersionEnum::MINOR)
            ->value
    )->toEqual('1.6.2.0');
});

it('can increment PrestashopOldVersion patch segment', function () {
    expect(
        PrestashopOldVersion::from('1.6.1.2')
            ->increment(SemanticVersionEnum::PATCH)
            ->value
    )->toEqual('1.6.1.3');
});

it('can return PrestashopOldVersion in underscored format', function () {
    expect(
        PrestashopOldVersion::from('1.6.1.2')->underscored()
    )->toEqual('1_6_1_2');
});

it('can return PrestashopOldVersion boundary', function () {
    expect(
        PrestashopOldVersion::from('1.6.0.0')
            ->boundary()
            ->value
    )->toEqual('1.6.9999.9999');
});

