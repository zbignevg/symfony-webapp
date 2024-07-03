<?php

namespace App\Tests\Service;

use App\Service\Converter\Rot13Converter;
use App\Service\Converter\StringPatternConverter;
use App\Service\Generator\RandomArrayGenerator;
use App\Service\Generator\RandomStringGenerator;
use App\Service\GeneratorsCollection;
use PHPUnit\Framework\TestCase;

class GeneratorsCollectionTest extends TestCase
{
    public function testAddAndGetGenerators()
    {
        $collection = new GeneratorsCollection();

        $randomStringGenerator = new RandomStringGenerator(8);
        $randomArrayGenerator = new RandomArrayGenerator(3, 6);
        $stringPatternConverter = new StringPatternConverter();
        $rot13Converter = new Rot13Converter();

        $collection->addGenerator($randomStringGenerator);
        $collection->addGenerator($randomArrayGenerator);
        $collection->addGenerator($stringPatternConverter);
        $collection->addGenerator($rot13Converter);

        $generators = $collection->getGenerators();

        $this->assertCount(4, $generators);

        // Assert that the generators are stored in the same order they were added
        $this->assertInstanceOf(RandomStringGenerator::class, $generators[0]);
        $this->assertInstanceOf(RandomArrayGenerator::class, $generators[1]);
        $this->assertInstanceOf(StringPatternConverter::class, $generators[2]);
        $this->assertInstanceOf(Rot13Converter::class, $generators[3]);
    }
}
