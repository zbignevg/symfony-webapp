<?php
// src/Service/Converter/StringPatternConverter.php
namespace App\Service\Converter;

class StringPatternConverter
{
    public function convert(string $input): string
    {
        $result = [];

        if (!empty($input)) {
            foreach (str_split($input) as $char) {
                if (ctype_digit($char)) {
                    $result[] = $char;
                } else {
                    $lowerChar = strtolower($char);
                    $result[] = ord($lowerChar) - ord('a') + 1;
                }
            }
        }

        return implode('/', $result);
    }
}
