<?php

namespace App\IpApi\Transformer;

use App\IpApi\Dto\Response\GeoDataResponse as InternalGeodataResponse;
use App\PublicDto\GeoData\GeoDataResponse;

class GeoDataResponseTransformer
{
    public function transform(InternalGeodataResponse $geodataResponse): GeoDataResponse
    {
        return new GeoDataResponse(
            $geodataResponse->getStatus(),
            $geodataResponse->getCountryCode(),
            $geodataResponse->getQuery(),
            $geodataResponse->getCountry()
        );
    }
}
