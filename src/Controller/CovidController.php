<?php

namespace App\Controller;

use App\CovidApi\CovidApi;
use App\IpApi\IpApi;
use App\PublicDto\Covid\CountryDetailsRequest;
use App\RequestResolver\IpResolver;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CovidController extends BaseController
{
    /**
     * @Route("/covid", methods={"GET"})
     */
    public function getCovidStatistics(Request $request, CovidApi $covidApi, IpResolver $ipResolver, IpApi $ipApi): JsonResponse
    {
        $geoData = $ipApi->getGeodata($ipResolver->resolve($request));
        $request = new CountryDetailsRequest($request->get('from'), $request->get('to'));
        $request->setCountrySlug($geoData->getCountry());

        return $this->getJsonResponse(
            $covidApi->getCountryDetails($request),
            Response::HTTP_OK
        );
    }
}
