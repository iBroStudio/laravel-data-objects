<?php

use IBroStudio\DataObjects\Support\DtoComparator;
use IBroStudio\DataObjects\Tests\Support\DTO\SimpleFakeDTO;

it('can compare 2 DTOs', function () {

    $user1 = new SimpleFakeDTO("Alice", 30, ["admin", "editor"]);
    $user2 = new SimpleFakeDTO("Alice", 30, ["editor", "admin"]);
    $user3 = new SimpleFakeDTO("Bob", 25, ["user"]);

    expect(DtoComparator::areEqual($user1, $user2))->toBeTrue()
        ->and(DtoComparator::areEqual($user1, $user3))->toBeFalse();
});


