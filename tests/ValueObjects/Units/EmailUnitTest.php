<?php

declare(strict_types=1);

use IBroStudio\DataObjects\ValueObjects\Units\EmailUnit;

it('can instantiate EmailUnit', function () {
    expect(EmailUnit::from(10))
        ->toBeInstanceOf(EmailUnit::class);
});

it('can return EmailUnit with unit', function () {
    expect(
        EmailUnit::from(1)->withUnit()
    )->toEqual('1 email')
        ->and(
            EmailUnit::from(10)->withUnit()
        )->toEqual('10 emails');
});

it('can return EmailUnit unit', function () {
    expect(EmailUnit::unit())
        ->toEqual(' emails');
});
