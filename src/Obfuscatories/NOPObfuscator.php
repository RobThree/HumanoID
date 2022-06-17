<?php

namespace RobThree\HumanoID\Obfuscatories;

class NOPObfuscator implements SymetricObfuscatorInterface
{

    public function obfuscate(int $id): int
    {
        return $id;
    }

    public function unobfuscate(int $id): int
    {
        return $id;
    }
}