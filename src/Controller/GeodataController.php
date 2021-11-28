<?php

namespace App\Controller;

use App\IpApi\IpApi;
use App\RequestResolver\IpResolver;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GeodataController extends BaseController
{
    /**
     * @Route("/geo-data", methods={"POST"})
     */
    public function getGeoData(Request $request, IpResolver $ipResolver, IpApi $ipApi): JsonResponse
    {
        return $this->getJsonResponse(
            $ipApi->getGeodata($ipResolver->resolve($request)),
            Response::HTTP_OK
        );
    }
}
