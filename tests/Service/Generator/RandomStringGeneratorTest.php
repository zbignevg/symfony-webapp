<?php
// tests/Service/Generator/RandomStringGeneratorTest.php

namespace App\Tests\Service\Generator;

use App\Service\Generator\RandomStringGenerator;
use PHPUnit\Framework\TestCase;

class RandomStringGeneratorTest extends TestCase
{
    public function testGenerateStringLength()
    {
        $generator = new RandomStringGenerator(10);
        $randomString = $generator->generate();

        $this->assertEquals(10, strlen($randomString));
    }

    public function testGenerateCharacterRange()
    {
        $generator = new RandomStringGenerator(20);
        $randomString = $generator->generate();

        // Check that each character in the generated string is within the expected range
        $this->assertRegExp('/^[a-zA-Z0-9]{20}$/', $randomString);
    }

    public function testGenerateEmptyString()
    {
        $generator = new RandomStringGenerator(0);
        $randomString = $generator->generate();

        $this->assertEquals('', $randomString);
    }
}
