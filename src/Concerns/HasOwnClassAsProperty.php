<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait HasOwnClassAsProperty
{
    public static function bootHasOwnClassAsProperty()
    {
        static::creating(function (Model $model) {
            $model->setAttribute(
                key: static::getOwnClassPropertyName(),
                value: get_class($model)
            );
        });

        static::addGlobalScope('class', function (Builder $builder) {
            $builder->where(static::getOwnClassPropertyName(), static::class);
        });
    }

    protected static function getOwnClassPropertyName(): string
    {
        return 'class';
    }
}
