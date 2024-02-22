<?php

namespace HumanoID\DictionaryBuilder\Dictionaries\Space;

use HumanoID\DictionaryBuilder\Dictionaries\DictionaryInterface;

class StarAdjectives implements DictionaryInterface
{

    public static function dictionary(): array
    {
        return [
            "colors" => static::colors(),
            "life-cycle" => static::lifeCycles(),
            "star-taxonomy" => static::taxonomy(),
        ];
    }

    public static function all(): array
    {
        return [
            ...static::colors(),
            ...static::lifeCycles(),
            ...static::taxonomy(),
        ];
    }

    public static function colors(): array
    {
        return [
            "Blue",
            "Brown",
            "Orange",
            "Red",
            "White",
            "Yellow",
        ];
    }

    public static function lifeCycles(): array
    {
        return [
            "Birth",
            "Dying",
            "Main",
            "Old",
            "Remnant",
        ];
    }

    public static function taxonomy(): array
    {
        return [
            "Brightgiant",
            "Browndwarf",
            "Hypergiant",
            "Reddwarf",
            "Subdwarf",
            "Subgiant",
            "Supergiant",
            "Whitedwarf",
        ];
    }
}