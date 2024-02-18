<?php

namespace RobThree\HumanoID;

use RobThree\HumanoID\Dictionaries\SpaceDictionary;
use RobThree\HumanoID\Dictionaries\ZooDictionary;

class DictionaryBuilder
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