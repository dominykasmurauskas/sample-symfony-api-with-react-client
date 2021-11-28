<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;

class BaseController extends AbstractController
{
    private const RESPONSE_FORMAT = 'json';

    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    protected function getJsonResponse($data, int $httpCode): JsonResponse
    {
        return new JsonResponse($this->getSerializedResponse($data), $httpCode, [], true);
    }

    protected function getSerializedResponse($data): string
    {
        return $this->serializer->serialize($data, self::RESPONSE_FORMAT);
    }
}
