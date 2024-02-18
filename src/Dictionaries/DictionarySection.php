<?php

namespace RobThree\HumanoID\Dictionaries;

use ReflectionClass;
use ReflectionMethod;

abstract class DictionarySection
{
    abstract public static function hasChildren(): bool;

    /**
     *  @return class-string[]
     **/
    public static function children(): array
    {
        if (!static::hasChildren()) {
            return [];
        }

        $classReflector = new ReflectionClass(static::class);
        $array_filter = [];
        foreach (get_declared_classes() as $value) {
            if (
                $value !== $classReflector->getName() &&
                str_starts_with($value, $classReflector->getName())
            ) {
                $array_filter[] = $value;
            }
        }
        return $array_filter;
    }

    /**
     * Return all the method names possible to call on this class - other than above 2.
     *  @return string[]
     **/
    public static function categories(): array
    {
        // TODO: reflection to get (public) methods not named in list, and not starting with __
        $classReflector = new ReflectionClass(static::class);
        $publicStaticMethods = array_filter(
            $classReflector->getMethods(ReflectionMethod::IS_STATIC),
            static function (ReflectionMethod $method) {
                return $method->isPublic() && ! $method->isAbstract();
            }
        );
        $safeMethods = array_filter(
            $publicStaticMethods,
            static function (ReflectionMethod $method) {
                $ignoreMethods = ['hasChildren', 'children', 'categories'];
                $name = $method->getName();
                return !str_starts_with($name, '__') && !in_array($name, $ignoreMethods);
            }
        );

        return array_values(array_map(static function ($value) {
            return $value->getName();
        }, $safeMethods));
    }
}
