<?php

namespace RobThree\HumanoID\Obfuscatories;

class NOPObfuscator implements SymmetricObfuscatorInterface
{

    public function obfuscate(int $id): int
    {
        return $id;
    }

    public function deobfuscate(int $id): int
    {
        return $id;
    }
}