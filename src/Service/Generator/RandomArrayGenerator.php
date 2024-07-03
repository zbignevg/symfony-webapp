<?php

namespace App\Service\Generator;

class RandomArrayGenerator
{
    private int $arraySize;
    private int $stringLength;

    public function __construct(int $arraySize, int $stringLength)
    {
        $this->arraySize = $arraySize;
        $this->stringLength = $stringLength;
    }

    public function generate(): array
    {
        $randomStringGenerator = new RandomStringGenerator($this->stringLength);
        $result = [];
        for ($i = 0; $i < $this->arraySize; $i++) {
            $result[] = $randomStringGenerator->generate();
        }

        return $result;
    }
}
