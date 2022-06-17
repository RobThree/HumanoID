<?php

namespace RobThree\HumanoID\Test\Obfuscator;

use RobThree\HumanoID\Obfuscatories\MissyElliottObfuscator;
use RobThree\HumanoID\Test\BaseTestCase;

class MissyElliottObfuscatorTest extends BaseTestCase
{
    use TestDataProvider;

    /**
     * @dataProvider provideMissyShiftIds
     */
    public function testObfuscate(int $id, int $expected)
    {
        $obfuscator = new MissyElliottObfuscator();
        $this->assertEquals($expected, $obfuscator->obfuscate($id));
    }

    /**
     * @dataProvider provideMissyShiftIds
     */
    public function testUnobfuscate(int $expected, int $id)
    {
        $obfuscator = new MissyElliottObfuscator();
        $this->assertEquals($expected, $obfuscator->unobfuscate($id));
    }
}