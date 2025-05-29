<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Casts;

use IBroStudio\DataObjects\ValueObjects\Authentication\AuthenticationAbstract;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

final class EloquentAuthenticationValueObjectCast implements CastsAttributes
{
    public function __construct(
        /** @var class-string<\IBroStudio\DataObjects\Contracts\AuthenticationContract> $authenticationValueObjectClass */
        protected string $authenticationValueObjectClass,
        protected array $arguments,
    ) {}

    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        if (is_null($value)) {
            return null;
        }

        return AuthenticationAbstract::getConcreteAuthenticationValueObject(
            class: $this->authenticationValueObjectClass,
            value: json_decode($value, true),
        );
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        if (is_null($value)) {
            return null;
        }

        return AuthenticationAbstract::getConcreteAuthenticationValueObject(
            class: $this->authenticationValueObjectClass,
            value: $value,
        )->toJson();
    }
}
