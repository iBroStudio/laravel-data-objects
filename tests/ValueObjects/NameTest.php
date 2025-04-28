<?php

declare(strict_types=1);

use IBroStudio\DataObjects\ValueObjects\Name;

it('can instantiate Name object value', function () {
    expect(Name::from('yann'))
        ->toBeInstanceOf(Name::class);
});

it('can format Name object value', function () {
    expect(
        Name::from('yanN')->value
    )->toEqual('Yann');
});
