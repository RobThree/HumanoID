<?php

namespace HumanoID\DictionaryBuilder\Dictionaries\Space;

use HumanoID\DictionaryBuilder\Dictionaries\DictionaryInterface;

class CelestialBodies implements DictionaryInterface
{

    public static function dictionary(): array
    {
        return [
            "planets" => static::planets(),
            "planetoids" => static::planetoids(),
        ];
    }

    public static function all(): array
    {
        return [
            ...static::planets(),
            ...static::planetoids(),
        ];
    }

    public static function planets(): array
    {
        return [
            "Earth",
            "Jupiter",
            "Mars",
            "Mercury",
            "Neptune",
            "Saturn",
            "Uranus",
            "Venus",
        ];
    }

    public static function planetoids(): array
    {
        return [
            "Ceres",
            "Eris",
            "Gonggong",
            "Haumea",
            "Makemake",
            "Orcus",
            "Pluto",
            "Quaoar",
            "Sedna",
        ];
    }
}