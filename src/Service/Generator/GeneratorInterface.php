<?php

namespace App\Service\Generator;

interface GeneratorInterface
{
    public function generate(): string|array;
}
