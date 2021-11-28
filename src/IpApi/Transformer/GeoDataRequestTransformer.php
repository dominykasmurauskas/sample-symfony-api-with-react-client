<?php

namespace App\IpApi\Transformer;

use App\IpApi\Dto\Request\GeoDataRequest;

class GeoDataRequestTransformer
{
    public function transform(string $clientIp): GeoDataRequest
    {
        return new GeoDataRequest($clientIp);
    }
}
