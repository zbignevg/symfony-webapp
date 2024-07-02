<?php
// src/Service/Converter/Rot13Converter.php
namespace App\Service\Converter;

class Rot13Converter
{
    public function convert(string $input): string
    {
        return str_rot13($input);
    }
}
