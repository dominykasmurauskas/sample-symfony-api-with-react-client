<?php

namespace App\Controller;

use App\CovidApi\CovidApi;
use App\PublicDto\Covid\CountryDetailsRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CovidController extends BaseController
{
    /**
     * @Route("/covid-data", methods={"POST"})
     */
    public function getGeoData(Request $request, CovidApi $covidApi): JsonResponse
    {
        $request = $this->buildRequestDto($request->getContent(), CountryDetailsRequest::class);

        return $this->getJsonResponse(
            $covidApi->getCountryDetails($request),
            Response::HTTP_OK
        );
    }
}
