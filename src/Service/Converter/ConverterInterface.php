<?php

namespace App\Service\Converter;

interface ConverterInterface
{
    public function getName(): string;
    public function convert(string $input): string;
}
