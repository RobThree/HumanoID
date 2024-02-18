<?php

namespace RobThree\HumanoID\Dictionaries;

use RobThree\HumanoID\Dictionaries\Adjectives\Colors;
use RobThree\HumanoID\Dictionaries\Zoo\Animals;

/**
 * This dictionary is meant to replicate the `zoo-words.json` file.
 */
class ZooDictionary implements DictionaryInterface
{
    /**
     * @return array{adjectives: string[], colors: string[], animals: string[]}
     */
    public static function dictionary(): array
    {
        return [
            "adjectives" => static::adjectives(),
            "colors" => static::colors(),
            "animals" => static::animals(),
        ];
    }

    public static function all(): array
    {
        return [
            ...static::adjectives(),
            ...static::colors(),
            ...static::animals(),
        ];
    }

    public static function adjectives(): array
    {
        return [
            ...Adjectives::emotionalTone(),
        ];
    }

    /**
     * @return array<array-key, string>
     */
    public static function colors(): array
    {
        return [
            ...Colors::primary(),
            ...Colors::secondary(),
            ...Colors::preciousMinerals(),
            ...Colors::redShades(),
            ...Colors::blueShades(),
            ...Colors::yellowShades(),
            ...Colors::greenShades(),
            ...Colors::purpleShades(),
            ...Colors::neutrals(),
            ...Colors::fruits(),
            ...Colors::misc(),
        ];
    }

    /**
     * @return array<array-key, string>
     */
    public static function animals(): array
    {
        return [
            ...Animals::terrestrial(),
            ...Animals::aquatic(),
            ...Animals::avian(),
            ...Animals::amphibians(),
            ...Animals::arthropods(),
        ];
    }
}