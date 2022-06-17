<?php

namespace RobThree\HumanoID\Obfuscatories;

abstract class AbstractBitAwareShiftObfuscator implements SymmetricObfuscatorInterface
{

    public static int $salt;

    public static bool $is32Bit = (PHP_INT_SIZE === 4);

    public function obfuscate(int $id): int
    {
        return static::$is32Bit ? static::obfuscate32($id) : static::obfuscate64($id) ^ static::$salt;
    }

    public function unobfuscate(int $id): int
    {
        $id ^= static::$salt;
        return static::$is32Bit ? static::unobfuscate32($id) : static::unobfuscate64($id);
    }

    abstract public static function obfuscate32(int $id): int;
    abstract public static function unobfuscate32(int $id): int;
    abstract public static function obfuscate64(int $id): int;
    abstract public static function unobfuscate64(int $id): int;
}