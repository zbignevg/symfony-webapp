<?php
//
//use App\Kernel;
//
//require_once dirname(__DIR__).'/vendor/autoload_runtime.php';
//
//return function (array $context) {
//    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
//};

// public/index.php
use App\Service\Generator\RandomStringGenerator;
use App\Service\Generator\RandomArrayGenerator;
use App\Service\GeneratorsCollection;
use App\Service\Converter\StringPatternConverter;
use App\Service\Converter\Rot13Converter;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

require dirname(__DIR__) . '/vendor/autoload.php';

$containerBuilder = new ContainerBuilder();

// Register Generators
$containerBuilder->register('random_string_generator', RandomStringGenerator::class)
    ->setArgument(0, 6); // Random string length
$containerBuilder->register('random_array_generator', RandomArrayGenerator::class)
    ->setArguments([5, 6]); // Array size and string length

// Register Converters
$containerBuilder->register('string_pattern_converter', StringPatternConverter::class)->setPublic(true);
$containerBuilder->register('rot13_converter', Rot13Converter::class)->setPublic(true);

// Register Generators Collection
$containerBuilder->register('generators_collection', GeneratorsCollection::class)
    ->setPublic(true)
    ->addMethodCall('addGenerator', [new Reference('random_string_generator')])
    ->addMethodCall('addGenerator', [new Reference('random_array_generator')]);

$containerBuilder->compile();

// Retrieve Generators Collection and Converters
$generatorsCollection = $containerBuilder->get('generators_collection');
$converters = [
    $containerBuilder->get('string_pattern_converter'),
    $containerBuilder->get('rot13_converter')
];

// Loop through collection and apply random Converter to each Generator
foreach ($generatorsCollection->getGenerators() as $generator) {
    $generated = $generator->generate();
    $converter = $converters[array_rand($converters)];
    if (is_array($generated)) {
        foreach ($generated as $string) {
            $converted = $converter->convert($string);
            echo "Original value: \"$string\" and converted: $converted<br/>";
        }
    } else {
        echo $converter->convert($generated) . "<br/>";
    }
}
