<?php

namespace RobThree\HumanoID\Obfuscatories;

class BasicShiftObfuscator implements SymmetricObfuscatorInterface
{

    public int $salt;

    public function __construct(int $salt)
    {
        $this->salt = $salt;
    }

    public function obfuscate(int $id): int
    {
        return $id ^ $this->salt;
    }

    public function unobfuscate(int $id): int
    {
        return $id ^ $this->salt;
    }
}