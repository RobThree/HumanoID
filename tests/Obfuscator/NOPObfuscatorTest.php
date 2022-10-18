<?php

namespace RobThree\HumanoID\Test\Obfuscator;

use RobThree\HumanoID\Obfuscatories\NOPObfuscator;
use RobThree\HumanoID\Test\BaseTestCase;

class NOPObfuscatorTest extends BaseTestCase
{
    use TestDataProvider;

    /**
     * @dataProvider provideNOPObfuscatorIds
     */
    public function testNOPObfuscate(int $id, int $expected)
    {
        $obfuscator = new NOPObfuscator();
        $this->assertEquals($expected, $obfuscator->obfuscate($id));
        $this->assertEquals($expected, $obfuscator->deobfuscate($id));
    }
}