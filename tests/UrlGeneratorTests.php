<?php
require_once '../src/UrlGenerator.php';

use PHPUnit\Framework\TestCase;

class UrlGeneratorTests extends TestCase
{
    private $defaultWordSet = [
        'adjectives' => ['big', 'funny', 'lazy'],
        'colors' => ['red', 'green', 'blue'],
        'animals' => ['dog', 'cat', 'hamster']
    ];
    
     public function testTestVectors() {
        $target = new UrlGenerator\UrlGenerator($this->defaultWordSet);
        $this->assertSame('dog',     $target->toUrl(0));
        $this->assertSame('cat',     $target->toUrl(1));
        $this->assertSame('hamster', $target->toUrl(2));

        $this->assertSame('red-dog',   $target->toUrl(3));
        $this->assertSame('green-dog', $target->toUrl(4));
        $this->assertSame('blue-dog',  $target->toUrl(5));
    }
}
