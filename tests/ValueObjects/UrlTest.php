<?php

declare(strict_types=1);

use IBroStudio\DataObjects\ValueObjects\Url;
use Illuminate\Validation\ValidationException;

it('can instantiate Url object value', function () {
    expect(Url::from('https://ibro.studio/test'))
        ->toBeInstanceOf(Url::class);
});

it('can get Url object value scheme', function () {
    expect(
        Url::from('https://ibro.studio/directory/test?val1=1&val2=2')->getScheme()
    )->toBe('https');
});

it('can get Url object value path segments', function () {
    $url = Url::from('https://ibro.studio/directory/test?val1=1&val2=2');

    expect($url->getSegment(1))->toBe('directory')
        ->and($url->getSegment(2))->toBe('test');
});

it('can get Url object value query parameters', function () {
    $url = Url::from('https://ibro.studio/directory/test?val1=1&val2=2');

    expect($url->getQuery())->toBe('val1=1&val2=2')
        ->and($url->getQueryParameter('val1'))->toBe('1')
        ->and($url->getQueryParameter('val2'))->toBe('2');
});

it('can validate Url object value', function () {
    Url::from('invalid url');
})->throws(ValidationException::class);
