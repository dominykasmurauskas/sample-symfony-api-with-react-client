<?php

namespace App\IpApi\Client;

use App\IpApi\Dto\Request\GeoDataRequest;
use App\IpApi\Dto\Response\GeoDataResponse;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class Client
{
    private string $ipApiHost;
    private ResponseDeserializer $deserializer;
    private HttpClientInterface $httpClient;

    public function __construct(
        string $ipApiHost,
        ResponseDeserializer $deserializer,
        HttpClientInterface $httpClient
    ) {
        $this->ipApiHost = $ipApiHost;
        $this->deserializer = $deserializer;
        $this->httpClient = $httpClient;
    }

    public function getGeodata(GeoDataRequest $geodataRequest): GeoDataResponse
    {
        $response = $this->httpClient->request(
            'GET',
            $this->ipApiHost.$geodataRequest->getIp(),
        );

        return $this->deserializer->deserialize(
            $response->getContent(),
            GeoDataResponse::class
        );
    }
}
