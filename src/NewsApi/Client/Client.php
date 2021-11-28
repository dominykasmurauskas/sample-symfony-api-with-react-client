<?php

namespace App\NewsApi\Client;

use App\NewsApi\Dto\Request\TopHeadlinesRequest;
use App\NewsApi\Dto\Response\TopHeadlinesResponse;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class Client
{
    private const PATH_TOP_HEADLINES = 'top-headlines';
    private const QUERY_PARAM_COUNTRY = 'country';
    private const QUERY_PARAM_API_KEY = 'apiKey';

    private string $newsApiHost;
    private string $newsApiKey;
    private ResponseDeserializer $deserializer;
    private HttpClientInterface $httpClient;

    public function __construct(
        string $newsApiHost,
        string $newsApiKey,
        ResponseDeserializer $deserializer,
        HttpClientInterface $httpClient
    ) {
        $this->newsApiHost = $newsApiHost;
        $this->newsApiKey = $newsApiKey;
        $this->deserializer = $deserializer;
        $this->httpClient = $httpClient;
    }

    public function getTopHeadlines(TopHeadlinesRequest $topHeadlinesRequest): TopHeadlinesResponse
    {
        $url = [
            $this->newsApiHost,
            self::PATH_TOP_HEADLINES,
            '?',
            http_build_query(
                [
                    self::QUERY_PARAM_COUNTRY => $topHeadlinesRequest->getCountryCode(),
                    self::QUERY_PARAM_API_KEY => $this->newsApiKey,
                ]
            )
        ];

        $response = $this->httpClient->request(
            'GET',
            implode($url)
        );

        return $this->deserializer->deserialize(
            $response->getContent(),
            TopHeadlinesResponse::class
        );
    }
}
