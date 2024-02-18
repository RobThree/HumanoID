<?php

namespace RobThree\HumanoID\Dictionaries\Adjectives;

use RobThree\HumanoID\Dictionaries\DictionarySection;

class Colors extends DictionarySection
{
    public static function hasChildren(): bool
    {
        return false;
    }

    /**
     * @return array<array-key, string>
     */
    public static function primary(): array
    {
        return [
            "red",
            "green",
            "blue",
        ];
    }

    /**
     * @return array<array-key, string>
     */
    public static function secondary(): array
    {
        return [
            "cyan",
            "magenta",
            "yellow",
        ];
    }

    /**
     * @return array<array-key, string>
     */
    public static function preciousMinerals(): array
    {
        return [
            "ruby",
            "gold",
            "copper",
            "bronze",
            "silver",
            "sapphire",
            "amethyst",
        ];
    }

    /**
     * @return array<array-key, string>
     */
    public static function redShades(): array
    {
        return [
            "cerise",
            "burgundy",
            "pink",
            "salmon",
            "puce",
            "rose",
            "coral",
            "scarlet",
            "crimson",
            "maroon",
            "carmine",
            "sangria",
            "blush",
            "red-violet",
            "magenta-rose",
        ];
    }

    /**
     * @return array<array-key, string>
     */
    public static function blueShades(): array
    {
        return [
            "cerulean",
            "persian-blue",
            "ultramarine",
            "indigo",
            "turquoise",
            "azure",
            "navy-blue",
            "prussian-blue",
            "cobalt-blue",
            "electric-blue",
            "baby-blue",
            "blue-violet",
        ];
    }

    /**
     * @return array<array-key, string>
     */
    public static function yellowShades(): array
    {
        return [
            "amber",
            "champagne",
            "ochre",
            "desert-sand",
            "orange-red",
        ];
    }

    /**
     * @return array<array-key, string>
     */
    public static function greenShades(): array
    {
        return [
            "viridian",
            "jungle-green",
            "emerald",
            "erin",
            "harlequin",
            "olive",
            "spring-green",
            "blue-green",
            "teal",
        ];
    }

    /**
     * @return array<array-key, string>
     */
    public static function purpleShades(): array
    {
        return [
            "lilac",
            "lavender",
            "violet",
            "orchid",
            "mauve",
            "amaranth",
            "byzantium",
            "purple",
        ];
    }

    /**
     * @return array<array-key, string>
     */
    public static function neutrals(): array
    {
        return [
            "gray",
            "slate-gray",
            "ivory",
            "white",
            "black",
            "taupe",
            "tan",
            "coffee",
            "beige",
            "brown",
            "chocolate",
        ];
    }

    /**
     * @return array<array-key, string>
     */
    public static function fruits(): array
    {
        return [
            "lime",
            "lemon",
            "raspberry",
            "peach",
            "plum",
            "pear",
            "apricot",
            "orange",
        ];
    }

    /**
     * @return array<array-key, string>
     */
    public static function misc(): array
    {
        return [
            "periwinkle",
            "jade",
            "aquamarine",
            "spring-bud",
        ];
    }
}