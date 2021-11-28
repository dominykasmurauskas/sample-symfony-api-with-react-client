<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends BaseController
{
    /**
     * @Route("/healthcheck", methods={"GET"})
     */
    public function healthcheck(): JsonResponse
    {
        return $this->getJsonResponse(['status' => 'OK'], Response::HTTP_OK);
    }
}
