<?php

namespace App\Tests\Service\Generator;

use App\Service\Generator\RandomArrayGenerator;
use App\Service\Generator\RandomStringGenerator;
use PHPUnit\Framework\TestCase;

class RandomArrayGeneratorTest extends TestCase
{
    public function testGenerate()
    {
        $mockRandomStringGenerator = $this->createMock(RandomStringGenerator::class);

        $mockRandomStringGenerator->expects($this->any())
            ->method('generate')
            ->willReturn('abc123');

        $generator = new RandomArrayGenerator(3, 6);

        // Generate the array
        $randomArray = $generator->generate();

        $this->assertCount(3, $randomArray);

        foreach ($randomArray as $string) {
            $this->assertEquals(6, strlen($string));
            $this->assertMatchesRegularExpression('/^[a-zA-Z0-9]+$/', $string);
        }
    }
}
