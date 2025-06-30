<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Tests\Support\Models;

use IBroStudio\DataObjects\Concerns\HasTempFolder;
use IBroStudio\DataObjects\Tests\Support\Database\Factories\FakeChildModelFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FakeChildModel extends FakeDataOwner
{
    use HasFactory;
    use HasTempFolder;

    public $table = 'fake_data_owners';

    protected static function newFactory(): Factory
    {
        return FakeChildModelFactory::new();
    }

    protected static function getOwnClassPropertyName(): string
    {
        return 'type';
    }
}
