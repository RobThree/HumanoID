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
		//TODO: Implement
    }
}
