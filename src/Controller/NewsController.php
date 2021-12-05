<?php

namespace App\Controller;

use App\IpApi\IpApi;
use App\NewsApi\News;
use App\RequestResolver\IpResolver;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewsController extends BaseController
{
    /**
     * @Route("/news", methods={"GET"})
     */
    public function getNews(Request $request, IpResolver $ipResolver, IpApi $ipApi, News $news): JsonResponse
    {
        $geoData = $ipApi->getGeodata($ipResolver->resolve($request));

        return $this->getJsonResponse($news->getTopHeadlines($geoData->getCountryCode()), Response::HTTP_OK);
    }
}
