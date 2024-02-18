<?php

namespace Dictionary;

use RobThree\HumanoID\Dictionaries\Adjectives;
use RobThree\HumanoID\Dictionaries\Adjectives\Colors;
use RobThree\HumanoID\Test\BaseTestCase;

class ColorsSectionTest extends BaseTestCase
{
    public function testColorsSectionMethods()
    {
        $this->assertFalse(Colors::hasChildren());
        $this->assertEmpty(Colors::children());
        $this->assertSame(
            [
                'primary',
                'secondary',
                'preciousMinerals',
                'redShades',
                'blueShades',
                'yellowShades',
                'greenShades',
                'purpleShades',
                'neutrals',
                'fruits',
                'misc',
            ],
            Colors::categories(),
        );

        $this->assertTrue(Adjectives::hasChildren());
        $this->assertSame(
            [
                Colors::class,
            ],
            Adjectives::children()
        );
    }
}