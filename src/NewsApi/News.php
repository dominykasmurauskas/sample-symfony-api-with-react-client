<?php

namespace App\NewsApi;

use App\NewsApi\Client\Client;
use App\NewsApi\Transformer\TopHeadlinesRequestTransformer;
use App\NewsApi\Transformer\TopHeadlinesResponseTransformer;
use App\PublicDto\News\TopHeadlinesResponse;

class News
{
    private TopHeadlinesRequestTransformer $topHeadlinesRequestTransformer;
    private TopHeadlinesResponseTransformer $topHeadlinesResponseTransformer;
    private Client $newsClient;

    public function __construct(
        TopHeadlinesRequestTransformer $topHeadlinesRequestTransformer,
        TopHeadlinesResponseTransformer $topHeadlinesResponseTransformer,
        Client $newsClient
    ) {
        $this->topHeadlinesRequestTransformer = $topHeadlinesRequestTransformer;
        $this->topHeadlinesResponseTransformer = $topHeadlinesResponseTransformer;
        $this->newsClient = $newsClient;
    }

    public function getTopHeadlines(string $countryCode): TopHeadlinesResponse
    {
        $request = $this->topHeadlinesRequestTransformer->transform($countryCode);
        $response = $this->newsClient->getTopHeadlines($request);

        return $this->topHeadlinesResponseTransformer->transform($response);
    }
}
