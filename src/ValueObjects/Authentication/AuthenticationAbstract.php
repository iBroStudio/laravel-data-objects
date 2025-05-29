<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\ValueObjects\Authentication;

use Exception;
use IBroStudio\DataObjects\Casts\EloquentAuthenticationValueObjectCast;
use IBroStudio\DataObjects\Contracts\AuthenticationContract;
use IBroStudio\DataObjects\ValueObjects\ValueObject;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Support\Arr;

abstract class AuthenticationAbstract extends ValueObject implements AuthenticationContract
{
    public static function getConcreteAuthenticationValueObject(string $class, array|AuthenticationContract $value): AuthenticationContract
    {
        if ($value instanceof AuthenticationContract) {
            return $value;
        }

        if (! is_subclass_of($class, self::class)) {
            $class = match (true) {
                Arr::hasAll($value, ['username', 'password']) => BasicAuthentication::class,
                Arr::hasAll($value, ['key', 'secret']) => S3Authentication::class,
                Arr::hasAny($value, ['publicKey', 'privateKey']) => SshKey::class,
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
