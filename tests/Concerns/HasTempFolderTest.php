<?php

use IBroStudio\DataObjects\Tests\Support\Models\FakeChildModel;
use IBroStudio\DataObjects\ValueObjects\TempFolder;

it('can return model TempFolder', function () {
    expect(
        FakeChildModel::factory()->create()->getTempFolder()
    )->toBeInstanceOf(TempFolder::class);
});
