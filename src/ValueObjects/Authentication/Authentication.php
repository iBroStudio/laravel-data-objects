<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\ValueObjects\Authentication;

use Exception;
use IBroStudio\DataObjects\Casts\EloquentAuthenticationValueObjectCast;
use IBroStudio\DataObjects\Contracts\AuthenticationContract;
use IBroStudio\DataObjects\ValueObjects\ValueObject;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

abstract class Authentication extends ValueObject implements AuthenticationContract
{
    public static function getConcreteAuthenticationValueObject(string $class, array|AuthenticationContract $value): AuthenticationContract
    {
        if ($value instanceof AuthenticationContract) {
            return $value;
        }

        if (! is_subclass_of($class, self::class)) {
            $class = match (array_keys($value)) {
                ['username', 'password'] => BasicAuthentication::class,
                ['key', 'secret'] => S3Authentication::class,
                ['user', 'public'], ['user', 'public', 'passphrase'] => SshKey::class,
                default => throw new Exception('Unsupported'),
            };
        }

        return $class::from(...$value);
    }

    /**
     * @param  array<string, mixed>  $arguments
     * @return EloquentAuthenticationValueObjectCast
     */
    public static function castUsing(array $arguments): CastsAttributes
    {
        return new EloquentAuthenticationValueObjectCast(static::class, $arguments);
    }
}
