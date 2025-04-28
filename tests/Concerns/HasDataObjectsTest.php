<?php

use IBroStudio\DataObjects\Tests\Support\Models\FakeDataOwner;

it('can have do property', function () {

    $model = FakeDataOwner::factory()
        ->create();

    dd($model->data_object);
});
