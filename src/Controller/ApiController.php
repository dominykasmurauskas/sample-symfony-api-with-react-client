<?php

namespace App\Controller;

use App\Controller\Annotation\ApiRoute;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @ApiRoute()
 */
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
