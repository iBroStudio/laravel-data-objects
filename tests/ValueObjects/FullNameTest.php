<?php

use IBroStudio\DataObjects\ValueObjects\FullName;

it('can instantiate FullName object value', function () {
    expect(FullName::from(fake()->name))
        ->toBeInstanceOf(FullName::class);
});

it('formats name FullName object value', function () {
    expect(
        FullName::from('Yann Roger Freppel')->value
    )->toEqual('Yann Roger FREPPEL');
});

it('can return FullName object value single property', function () {
    $fullname = FullName::from('Yann Roger Freppel');

    expect($fullname->firstname)->toEqual('Yann Roger')
        ->and($fullname->lastname)->toEqual('FREPPEL');
});

it('can return FullName object value properties', function () {
    $fullname = FullName::from('Yann Roger Freppel');

    expect($fullname->properties())->toMatchArray([
        'value' => 'Yann Roger FREPPEL',
        'firstname' => 'Yann Roger',
        'lastname' => 'FREPPEL',
    ]);
});
