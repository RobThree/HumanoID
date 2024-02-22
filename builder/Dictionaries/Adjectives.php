<?php

namespace HumanoID\DictionaryBuilder\Dictionaries;

class Adjectives extends DictionarySection
{
    public static function hasChildren(): bool
    {
        return true;
    }

    public static function colors(): array
    {
        // TODO: Reconsider how this should work - maybe not at all?
        // If we expose the sub sections as methods programmatically, that means
        // results change as we add new category methods to respective sections too.
        // return Colors::all();
        return [];
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
