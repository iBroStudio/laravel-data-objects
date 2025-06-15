<?php

declare(strict_types=1);

use IBroStudio\DataObjects\ValueObjects\Domain;
use Illuminate\Validation\ValidationException;

it('can instantiate Domain object value', function () {
    expect(Domain::from('www.ibro.studio'))
        ->toBeInstanceOf(Domain::class);
});

it('can get Domain object value', function () {
    expect(
        Domain::from('www.ibro.studio')->value
    )
        ->toBe('www.ibro.studio');
});

it('can return Domain object value single property', function () {
    $domain = Domain::from('www.ibro.studio');

    expect($domain->subDomain)->toEqual('www')
        ->and($domain->name)->toEqual('ibro')
        ->and($domain->tld)->toEqual('studio')
        ->and($domain->registrableDomain)->toEqual('ibro.studio');
});

it('can return Domain object value properties', function () {
    $fullname = Domain::from('www.ibro.studio');

    expect($fullname->values())->toMatchArray([
        'value' => 'www.ibro.studio',
        'subDomain' => 'www',
        'name' => 'ibro',
        'tld' => 'studio',
        'registrableDomain' => 'ibro.studio',
    ]);
});

it('can extract Domain object value from an url', function () {
    expect(
        Domain::from('https://www.ibro.studio/test')->value
    )
        ->toBe('www.ibro.studio');
});

it('can validate Domain object value', function () {
    Domain::from('123');
})->throws(ValidationException::class);
