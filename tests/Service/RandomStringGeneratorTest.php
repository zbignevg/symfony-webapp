<?php
// tests/Service/RandomStringGeneratorTest.php

namespace App\Tests\Service;

use App\Service\Generator\RandomStringGenerator;
use PHPUnit\Framework\TestCase;

class RandomStringGeneratorTest extends TestCase
{
    public function testGenerate()
    {
        $generator = new RandomStringGenerator(6);
        $randomString = $generator->generate();

        $this->assertEquals(6, strlen($randomString));
        $this->assertMatchesRegularExpression('/^[a-zA-Z0-9]+$/', $randomString);
    }
}
