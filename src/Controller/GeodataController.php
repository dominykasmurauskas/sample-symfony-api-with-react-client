<?php

namespace App\Controller;

use App\Controller\Annotation\ApiRoute;
use App\IpApi\Client\Client;
use App\IpApi\Dto\Request\GeoDataRequest;
use App\IpApi\IpApi;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @ApiRoute()
 */
class GeodataController extends BaseController
{
    /**
     * @Route("/geo-data", methods={"POST"})
     */
    public function getGeoData(Request $request, IpApi $ipApi): JsonResponse
    {
        return $this->getJsonResponse($ipApi->getGeodata(('54.93.127.13')), Response::HTTP_OK);
    }
}
