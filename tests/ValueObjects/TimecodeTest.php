<?php

declare(strict_types=1);

use IBroStudio\DataObjects\ValueObjects\Timecode;
use Illuminate\Validation\ValidationException;

it('can instantiate Timecode object value from string', function () {
    expect(
        Timecode::from(fake()->time('H:i:s:v'))
    )->toBeInstanceOf(Timecode::class);
});

it('can instantiate Timecode object value from float', function () {
    expect(
        Timecode::from(microtime(true))
    )->toBeInstanceOf(Timecode::class);
});

it('can return Timecode object value', function () {
    expect(
        Timecode::from('5:4:2:4545')->value
    )->toEqual('05:04:02.454500');
});

it('can validate Timecode object value', function () {
    Timecode::from('invalid timecode');
})->throws(ValidationException::class);

it('can not validate Timecode object value with wrong seconds', function () {
    Timecode::from('5:4:60:4545');
})->throws(ValidationException::class, 'Seconds can not be greater than 59.');

it('can not validate Timecode object value with wrong minutes', function () {
    Timecode::from('5:60:2:4545');
})->throws(ValidationException::class, 'Minutes can not be greater than 59.');
