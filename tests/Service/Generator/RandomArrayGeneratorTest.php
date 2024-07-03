<?php

namespace App\Tests\Service\Generator;

use App\Service\Generator\RandomArrayGenerator;
use App\Service\Generator\RandomStringGenerator;
use PHPUnit\Framework\TestCase;

class RandomArrayGeneratorTest extends TestCase
{
    public function testGenerate()
    {
        // Mocking RandomStringGenerator to isolate the unit test
        $mockRandomStringGenerator = $this->createMock(RandomStringGenerator::class);

        // Set up expectations for the mock generator
        $mockRandomStringGenerator->expects($this->any())
            ->method('generate')
            ->willReturn('abc123'); // Replace with a sample generated string

        // Instantiate RandomArrayGenerator with mocked RandomStringGenerator
        $generator = new RandomArrayGenerator(3, 6);

        // Generate the array
        $randomArray = $generator->generate();

        // Assertions
        $this->assertCount(3, $randomArray); // Check array size

        foreach ($randomArray as $string) {
            $this->assertEquals(6, strlen($string)); // Check string length
            $this->assertMatchesRegularExpression('/^[a-zA-Z0-9]+$/', $string); // Check string pattern
        }
    }
}
