<?php

namespace RobThree\HumanoID\Test\Obfuscator;

use RobThree\HumanoID\Obfuscatories\AbstractShiftObfuscator;

class TestShiftObfuscator extends AbstractShiftObfuscator
{
    public static int $salt = 42;
}