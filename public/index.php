<?php

use App\Service\Converter\Rot13Converter;
use App\Service\Converter\StringPatternConverter;
use App\Service\Generator\RandomArrayGenerator;
use App\Service\Generator\RandomStringGenerator;
use App\Service\GeneratorsCollection;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

require dirname(__DIR__) . '/vendor/autoload.php';

$containerBuilder = new ContainerBuilder();
$containerBuilder->register(RandomStringGenerator::class, RandomStringGenerator::class)
    ->addTag('app.generator')
    ->setArgument(0, 6);
$containerBuilder->register(RandomArrayGenerator::class, RandomArrayGenerator::class)
    ->addTag('app.generator')
    ->setArguments([5, 6]);
$containerBuilder->register(StringPatternConverter::class, StringPatternConverter::class)
    ->addTag('app.converter')
    ->setPublic(true);
$containerBuilder->register(Rot13Converter::class, Rot13Converter::class)
    ->addTag('app.converter')
    ->setPublic(true);
$generatorsCollection = $containerBuilder->register('generators_collection', GeneratorsCollection::class)
    ->setPublic(true);
foreach ($containerBuilder->findTaggedServiceIds('app.generator') as $id => $tags) {
    $generatorsCollection->addMethodCall('addGenerator', [new Reference($id)]);
}

$containerBuilder->compile();

$generatorsCollection = $containerBuilder->get('generators_collection');
$converters = [];
foreach ($containerBuilder->findTaggedServiceIds('app.converter') as $id => $tags) {
    $converters[] = $containerBuilder->get($id);
}

foreach ($generatorsCollection->getGenerators() as $generator) {
    $generated = $generator->generate();
    $converter = $converters[array_rand($converters)];
    $converterName = $converter->getName();

    if (is_array($generated)) {
        echo "<br/> Array strings generator<br/>";
        foreach ($generated as $string) {
            $converted = $converter->convert($string);
            echo "Original value: \"$string\" and converted ($converterName): $converted<br/>";
        }
    } else {
        $converted = $converter->convert($generated);
        echo "String generator<br/>";
        echo "Original value: \"$generated\" and converted ($converterName): $converted <br/>";
    }
}
