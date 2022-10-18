<?php

namespace RobThree\HumanoID\Obfuscatories;

abstract class AbstractBitAwareShiftObfuscator extends BasicShiftObfuscator
{
    public static bool $is32Bit = (PHP_INT_SIZE === 4);

    public function obfuscate(int $id): int
    {
        return static::$is32Bit ? static::obfuscate32($id) : static::obfuscate64($id) ^ $this->salt;
    }

    public function deobfuscate(int $id): int
    {
        $id ^= $this->salt;
        return static::$is32Bit ? static::deobfuscate32($id) : static::deobfuscate64($id);
    }

    abstract public static function obfuscate32(int $id): int;
    abstract public static function deobfuscate32(int $id): int;
    abstract public static function obfuscate64(int $id): int;
    abstract public static function deobfuscate64(int $id): int;
}