<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Tests\Support\Database\Factories;

use IBroStudio\DataObjects\Tests\Support\Models\FakeChildModel;

class FakeChildModelFactory extends FakeDataOwnerFactory
{
    protected $model = FakeChildModel::class;
}
