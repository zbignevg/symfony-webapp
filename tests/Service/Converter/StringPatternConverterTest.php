<?php

namespace App\Tests\Service;

use App\Service\Converter\StringPatternConverter;
use PHPUnit\Framework\TestCase;

class StringPatternConverterTest extends TestCase
{
    public function testConvertWithDigits()
    {
        $converter = new StringPatternConverter();

        $input = 'a1b2c3';
        $expectedOutput = '1/1/2/2/3/3';

        $output = $converter->convert($input);

        $this->assertEquals($expectedOutput, $output);
    }

    public function testConvertWithoutDigits()
    {
        $converter = new StringPatternConverter();

        $input = 'abc';
        $expectedOutput = '1/2/3';

        $output = $converter->convert($input);

        $this->assertEquals($expectedOutput, $output);
    }

    public function testConvertMixedCase()
    {
        $converter = new StringPatternConverter();

        $input = 'AbC';
        $expectedOutput = '1/2/3';

        $output = $converter->convert($input);

        $this->assertEquals($expectedOutput, $output);
    }

    public function testConvertEmptyString()
    {
        $converter = new StringPatternConverter();

        $input = '';
        $expectedOutput = '';

        $output = $converter->convert($input);

        $this->assertEquals($expectedOutput, $output);
    }

    public function testGetName()
    {
        $converter = new StringPatternConverter();
        $expectedName = 'String pattern';

        $name = $converter->getName();

        $this->assertEquals($expectedName, $name);
    }
}
