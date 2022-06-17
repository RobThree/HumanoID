<?php

namespace RobThree\HumanoID\Test\Obfuscator;

use RobThree\HumanoID\Obfuscatories\BasicShiftObfuscator;
use RobThree\HumanoID\Test\BaseTestCase;

class BasicShiftObfuscatorTest extends BaseTestCase
{
    use TestDataProvider;

    /**
     * @dataProvider provideBasicShiftIds
     */
    public function testObfuscate(int $id, int $expected)
    {
        $obfuscator = new BasicShiftObfuscator(42);
        $this->assertEquals($expected, $obfuscator->obfuscate($id));
    }

    /**
     * @dataProvider provideBasicShiftIds
     */
    public function testUnobfuscate(int $expected, int $id)
    {
        $obfuscator = new BasicShiftObfuscator(42);
        $this->assertEquals($expected, $obfuscator->unobfuscate($id));
    }
}