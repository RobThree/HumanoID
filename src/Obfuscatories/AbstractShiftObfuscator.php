<?php

namespace RobThree\HumanoID\Obfuscatories;

abstract class AbstractShiftObfuscator implements SymmetricObfuscatorInterface
{

    public static int $salt;

    public function obfuscate(int $id): int
    {
        return $id ^ static::$salt;
    }

    public function unobfuscate(int $id): int
    {
        return $id ^ static::$salt;
    }
}