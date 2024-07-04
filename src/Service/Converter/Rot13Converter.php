<?php

namespace App\Service\Converter;

class Rot13Converter implements ConverterInterface
{
    private string $name = 'ROT13';

    public function getName(): string
    {
        return $this->name;
    }

    public function convert(string $input): string
    {
        return str_rot13($input);
    }
}
