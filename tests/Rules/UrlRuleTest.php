<?php

declare(strict_types=1);

use IBroStudio\DataObjects\Rules\UrlRule;
use Illuminate\Validation\ValidationException;

it('passes validation with valid UrlRule values', function () {
    Validator::make(
        [
            'attribute1' => 'https://example.com',
            'attribute2' => 'http://example.org',
            'attribute3' => 'https://example.net/path',
            'attribute4' => 'http://example.io/path?query=value',
            'attribute5' => 'https://example.co.uk/path#fragment',

        ],
        [
            'attribute1' => new UrlRule(),
            'attribute2' => new UrlRule(),
            'attribute3' => new UrlRule(),
            'attribute4' => new UrlRule(),
            'attribute5' => new UrlRule(),
        ]
    )
        ->validate();

    expect(true)->toBeTrue();
});

it('passes validation with null value', function () {
    Validator::make(
        ['attribute' => null],
        ['attribute' => new UrlRule()]
    )
        ->validate();

    expect(true)->toBeTrue();
});

it('fails validation with invalid value', function () {
    Validator::make(
        ['attribute' => 'invalid-value'],
        ['attribute' => new UrlRule()]
    )
        ->validate();
})->throws(ValidationException::class);
