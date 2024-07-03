<?php
// tests/Service/Rot13ConverterTest.php

namespace App\Tests\Service;

use App\Service\Converter\Rot13Converter;
use PHPUnit\Framework\TestCase;

class Rot13ConverterTest extends TestCase
{
    public function testConvertEmptyString()
    {
        $converter = new Rot13Converter();
        $input = '';
        $expectedOutput = '';

        $output = $converter->convert($input);

        $this->assertEquals($expectedOutput, $output);
    }

    public function testConvertAlphabet()
    {
        $converter = new Rot13Converter();
        $input = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $expectedOutput = 'nopqrstuvwxyzabcdefghijklmNOPQRSTUVWXYZABCDEFGHIJKLM';

        $output = $converter->convert($input);

        $this->assertEquals($expectedOutput, $output);
    }

    public function testConvertDigitsAndSymbols()
    {
        $converter = new Rot13Converter();
        $input = '123!@#$';
        $expectedOutput = '123!@#$'; // Digits and symbols remain unchanged

        $output = $converter->convert($input);

        $this->assertEquals($expectedOutput, $output);
    }

    public function testConvertMixedCase()
    {
        $converter = new Rot13Converter();
        $input = 'AbCdEfG';
        $expectedOutput = 'NoPqRsT';

        $output = $converter->convert($input);

        $this->assertEquals($expectedOutput, $output);
    }
}