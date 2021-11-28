<?php

namespace App\Controller;

use App\Controller\Annotation\ApiRoute;
use App\IpApi\Client\Client;
use App\IpApi\Dto\Request\GeodataRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @ApiRoute()
 */
class NewsController extends BaseController
{
    /**
     * @Route("/news", methods={"POST"})
     */
    public function getNews(Request $request, Client $apiClient): JsonResponse
    {
        return $this->getJsonResponse($apiClient->getGeodata(new GeodataRequest($request->getClientIp())), Response::HTTP_OK);
    }
}
