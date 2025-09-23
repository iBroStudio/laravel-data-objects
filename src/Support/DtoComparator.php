<?php

declare(strict_types=1);

namespace IBroStudio\DataObjects\Support;

use Illuminate\Support\Facades\Cache;
use ReflectionClass;
use ReflectionProperty;

class DtoComparator
{
    public static function areEqual(object $a, object $b, array $exclude = []): bool
    {
        $class = get_class($a);

        if ($class !== get_class($b)) {
            return false;
        }

        $propertyNames = Cache::rememberForever("dto_properties:$class", function () use ($class) {

            $reflection = new ReflectionClass($class);
            $names = [];

            foreach ($reflection->getProperties(ReflectionProperty::IS_PUBLIC) as $property) {
                $names[] = $property->getName();
            }

            return $names;
        });

        foreach ($propertyNames as $name) {
            if (in_array($name, $exclude, true)) {
                continue;
            }

            $valA = $a->{$name} ?? null;
            $valB = $b->{$name} ?? null;

            if (is_object($valA) && is_object($valB)) {
                if (! self::areEqual($valA, $valB, $exclude)) {
                    return false;
                }
            } elseif (is_array($valA) && is_array($valB)) {
                if (! self::arraysAreEqual($valA, $valB)) {
                    return false;
                }
            } else {
                if ($valA !== $valB) {
                    return false;
                }
            }
        }

        return true;
    }

    protected static function arraysAreEqual(array $a, array $b): bool
    {
        if (count($a) !== count($b)) {
            return false;
        }

        $isAssoc = self::isAssoc($a) || self::isAssoc($b);

        if ($isAssoc) {
            ksort($a);
            ksort($b);
        } else {
            sort($a);
            sort($b);
        }

        foreach ($a as $key => $value) {
            if (! array_key_exists($key, $b)) {
                return false;
            }

            if (is_array($value) && is_array($b[$key])) {
                if (! self::arraysAreEqual($value, $b[$key])) {
                    return false;
                }
            } elseif ($value !== $b[$key]) {
                return false;
            }
        }

        return true;
    }

    protected static function isAssoc(array $arr): bool
    {
        return array_keys($arr) !== range(0, count($arr) - 1);
    }
}
