<?php

namespace HumanoID\DictionaryBuilder;

use HumanoID\DictionaryBuilder\Dictionaries\SpaceDictionary;
use HumanoID\DictionaryBuilder\Dictionaries\ZooDictionary;

class DefaultDictionaries
{
    public static function spaceWords(): array
    {
        return SpaceDictionary::dictionary();
    }

    public static function zooWords(): array
    {
        return ZooDictionary::dictionary();
    }
}