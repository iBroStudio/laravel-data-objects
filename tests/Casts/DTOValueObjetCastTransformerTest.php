<?php

use IBroStudio\DataObjects\Tests\Support\DTO\FakeDTO;
use IBroStudio\DataObjects\Tests\Support\Models\FakeDataOwner;

it('can cast DTO property with value object', function () {
    FakeDTO::from(
        FakeDataOwner::factory()->raw()['data_object']
    );

})->throwsNoExceptions();
