<?php

namespace App\News;

use App\News\Client\Client;
use App\News\Transformer\TopHeadlinesRequestTransformer;
use App\News\Transformer\TopHeadlinesResponseTransformer;
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
