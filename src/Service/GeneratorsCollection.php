<?php

namespace App\Service;

class GeneratorsCollection
{
    private array $generators = [];

    public function addGenerator($generator): void
    {
        $this->generators[] = $generator;
    }

    public function getGenerators(): array
    {
        return $this->generators;
    }
}
