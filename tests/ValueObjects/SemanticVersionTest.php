<?php

declare(strict_types=1);

use IBroStudio\DataObjects\Enums\SemanticVersionEnum;
use IBroStudio\DataObjects\ValueObjects\SemanticVersion;
use Illuminate\Validation\ValidationException;

it('can instantiate SemanticVersion object value', function () {
    expect(
        SemanticVersion::from(fake()->semver())
    )->toBeInstanceOf(SemanticVersion::class);
});

it('can return SemanticVersion object value', function () {
    $version = fake()->semver();

    expect(
        SemanticVersion::from($version)->value
    )->toEqual($version);
});

it('can handle SemanticVersion object value with prefix', function () {
    $version = 'v.'.fake()->semver();

    expect(
        SemanticVersion::from($version)->value
    )->toEqual($version);
});

it('can return prefixed SemanticVersion object value without prefix', function () {
    $version = fake()->semver();

    expect(
        SemanticVersion::from('v.'.$version)->withoutPrefix()
    )->toEqual($version);
});

it('can validate SemanticVersion object value', function () {
    SemanticVersion::from('invalid version');
})->throws(ValidationException::class);

it('can increment SemanticVersion major segment', function () {

    expect(
        SemanticVersion::from('1.0.0')
            ->increment(SemanticVersionEnum::MAJOR)
            ->value
    )->toEqual('2.0.0');
});

it('can increment SemanticVersion minor segment', function () {
    expect(
        SemanticVersion::from('1.0.0')
            ->increment(SemanticVersionEnum::MINOR)
            ->value
    )->toEqual('1.1.0');
});

it('can increment SemanticVersion patch segment', function () {
    expect(
        SemanticVersion::from('1.0.0')
            ->increment(SemanticVersionEnum::PATCH)
            ->value
    )->toEqual('1.0.1');
});

it('can increment SemanticVersion with prefix', function () {
    expect(
        SemanticVersion::from('v.1.0.0')
            ->increment(SemanticVersionEnum::MAJOR)
            ->value
    )->toEqual('v.2.0.0');
});

it('can return SemanticVersion in underscored format', function () {
    expect(
        SemanticVersion::from('v.1.0.0')->underscored()
    )->toEqual('v_1_0_0');
});

it('can return SemanticVersion boundary', function () {
    expect(
        SemanticVersion::from('1.0.0')
            ->boundary()
            ->value
    )->toEqual('1.9999.9999');
});
