<?php

namespace RobThree\HumanoID\Dictionaries;

class Colors implements DictionaryInterface
{
    public static function dictionary(): array
    {
        return [
            "primary" => static::primary(),
            "secondary" => static::secondary(),
            "preciousMinerals" => static::preciousMinerals(),
            "redShades" => static::redShades(),
            "blueShades" => static::blueShades(),
            "yellowShades" => static::yellowShades(),
            "greenShades" => static::greenShades(),
            "purpleShades" => static::purpleShades(),
            "neutrals" => static::neutrals(),
            "fruits" => static::fruits(),
            "misc" => static::misc(),
        ];
    }

    /**
     * @return array<array-key, string>
     */
    public static function all(): array
    {
        return [
            ...static::primary(),
            ...static::secondary(),
            ...static::preciousMinerals(),
            ...static::redShades(),
            ...static::blueShades(),
            ...static::yellowShades(),
            ...static::greenShades(),
            ...static::purpleShades(),
            ...static::neutrals(),
            ...static::fruits(),
            ...static::misc(),
        ];
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