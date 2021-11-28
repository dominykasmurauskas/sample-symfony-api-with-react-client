<?php

namespace App\IpApi\Client;

use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class ResponseDeserializer
{
    private const FORMAT = 'json';

    public function deserialize(string $content, string $class)
    {
        $context = [
            AbstractObjectNormalizer::ALLOW_EXTRA_ATTRIBUTES => true,
        ];

        return $this->getDeserializer()->deserialize($content, $class, self::FORMAT, $context);
    }

    private function getDeserializer(): SerializerInterface
    {
        $reflectionExtractor = new ReflectionExtractor();
        $phpDocExtractor = new PhpDocExtractor();
        $propertyTypeExtractor = new PropertyInfoExtractor(
            [$reflectionExtractor],
            [$phpDocExtractor, $reflectionExtractor],
            [$phpDocExtractor],
            [$reflectionExtractor],
            [$reflectionExtractor],
        );

        $normalizers = [
            new ArrayDenormalizer(),
            new ObjectNormalizer(
                null,
                null,
                null,
                $propertyTypeExtractor
            )
        ];

        return new Serializer($normalizers, [self::FORMAT => new JsonEncoder()]);
    }
}
