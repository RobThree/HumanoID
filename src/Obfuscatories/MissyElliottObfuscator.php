<?php

namespace RobThree\HumanoID\Obfuscatories;

class MissyElliottObfuscator implements SymmetricObfuscatorInterface
{

    public function obfuscate(int $id): int
    {
        $binaryInt = str_pad(decbin($id), 32, '0', STR_PAD_LEFT);
        $workIt = str_split($binaryInt, 1);
        $workIt = static::putMyThingDown($workIt);
        $workIt = static::flipIt($workIt);
        $workIt = array_reverse($workIt);
        return bindec(implode('', $workIt));
    }

    private static function putMyThingDown(array &$workIt): array
    {
        $putMyThingDown = static function($thing) use (&$workIt) {
            array_unshift($workIt, $thing);
        };
        $putMyThingDown(array_pop($workIt));
        return $workIt;
    }

    private static function flipIt(array $it): array
    {
        return array_map(static function($n) {
            $bool = filter_var($n, FILTER_VALIDATE_BOOLEAN);
            $invertBool = !$bool;
            return (string) (int) $invertBool;
        }, $it);
    }

    private static function pickItBackUp(array &$workIt): array
    {
        $putMyThingDown = static function($thing) use (&$workIt) {
            array_push($workIt, $thing);
        };
        $putMyThingDown(array_shift($workIt));
        return $workIt;
    }

    public function unobfuscate(int $id): int
    {
        $binaryInt = str_pad(decbin($id), 32, '0', STR_PAD_LEFT);
        $unWorkIt = str_split($binaryInt, 1);
        $unWorkIt = array_reverse($unWorkIt);
        $unWorkIt = static::flipIt($unWorkIt);
        $unWorkIt = static::pickItBackUp($unWorkIt);

        return bindec(implode('', $unWorkIt));
    }
}