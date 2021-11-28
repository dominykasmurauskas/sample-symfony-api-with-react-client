<?php

namespace App\IpApi;

use App\IpApi\Client\Client;
use App\IpApi\Transformer\GeoDataRequestTransformer;
use App\IpApi\Transformer\GeoDataResponseTransformer;
use App\PublicDto\GeoData\GeoDataResponse;

class IpApi
{
    private GeoDataRequestTransformer $geoDataRequestTransformer;
    private GeoDataResponseTransformer $geoDataResponseTransformer;
    private Client $apiClient;

    public function __construct(
        GeoDataRequestTransformer $geoDataRequestTransformer,
        GeoDataResponseTransformer $geoDataResponseTransformer,
        Client $apiClient
    ) {
        $this->geoDataRequestTransformer = $geoDataRequestTransformer;
        $this->geoDataResponseTransformer = $geoDataResponseTransformer;
        $this->apiClient = $apiClient;
    }

    public function getGeodata(string $clientIp): GeoDataResponse
    {
        $requestDto = $this->geoDataRequestTransformer->transform($clientIp);
        $response = $this->apiClient->getGeodata($requestDto);

        return $this->geoDataResponseTransformer->transform($response);
    }
}
