<?php

namespace App\CovidApi\Client;

use App\CovidApi\Dto\Request\CountryDetailsRequest;
use App\CovidApi\Dto\Response\DayStatistics;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class Client
{
    private const PATH_COUNTRY = 'country/';
    private const QUERY_PARAM_DATE_FROM = 'from';
    private const QUERY_PARAM_DATE_TO = 'to';

    private string $covidApiHost;
    private ResponseDeserializer $deserializer;
    private HttpClientInterface $httpClient;

    public function __construct(
        string $covidApiHost,
        ResponseDeserializer $deserializer,
        HttpClientInterface $httpClient
    ) {
        $this->covidApiHost = $covidApiHost;
        $this->deserializer = $deserializer;
        $this->httpClient = $httpClient;
    }

    public function getCountryDetails(CountryDetailsRequest $countryDetailsRequest): array
    {
        $url = [
            $this->covidApiHost,
            self::PATH_COUNTRY,
            $countryDetailsRequest->getCountrySlug(),
            '?',
            http_build_query(
                [
                    self::QUERY_PARAM_DATE_FROM => $countryDetailsRequest->getDateFrom()->format('Y-m-d'),
                    self::QUERY_PARAM_DATE_TO => $countryDetailsRequest->getDateTo()->format('Y-m-d'),
                ]
            )
        ];

        $response = $this->httpClient->request(
            'GET',
            implode($url)
        );

        return $this->deserializer->deserialize(
            $response->getContent(),
            DayStatistics::class.'[]'
        );
    }
}
