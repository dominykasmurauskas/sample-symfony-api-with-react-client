<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

class BaseController extends AbstractController
{
    private const CONTENT_FORMAT = 'json';

    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    protected function buildRequestDto(string $content, string $class)
    {
        if (!$content) {
            return new $class();
        }

        $serializerContext = [
            AbstractNormalizer::ALLOW_EXTRA_ATTRIBUTES => true,
        ];

        return $this->serializer->deserialize($content, $class, self::CONTENT_FORMAT, $serializerContext);
    }

    protected function getJsonResponse($data, int $httpCode): JsonResponse
    {
        return new JsonResponse($this->getSerializedResponse($data), $httpCode, [], true);
    }

    protected function getSerializedResponse($data): string
    {
        return $this->serializer->serialize($data, self::CONTENT_FORMAT);
    }
}
