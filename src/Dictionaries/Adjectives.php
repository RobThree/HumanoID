<?php

namespace RobThree\HumanoID\Dictionaries;

class Adjectives implements DictionaryInterface
{
    public static function dictionary(): array
    {
        return [
            "colors" => static::colors(),
        ];
    }

    public static function all(): array
    {
        return [
            ...static::colors(),
            ...static::emotionalTone(),
            ...static::physicalAttributes(),
            ...static::personalityTraits(),
            ...static::temporalAttributes(),
            ...static::usageContext(),
            ...static::socialContext(),
            ...static::intensityContext(),
        ];
    }

    public static function colors(): array
    {
        return Colors::all();
    }

    public static function emotionalTone(): array
    {
        return [];
    }

    public static function physicalAttributes(): array
    {
        return [];
    }

    public static function personalityTraits(): array
    {
        return [];
    }

    public static function temporalAttributes(): array
    {
        return [];
    }

    public static function usageContext(): array
    {
        return [];
    }

    public static function socialContext(): array
    {
        return [];
    }

    public static function intensityContext(): array
    {
        return [];
    }
}