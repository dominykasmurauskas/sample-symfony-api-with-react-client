<?php

namespace App\News\Transformer;

use App\News\Dto\Request\TopHeadlinesRequest;

class TopHeadlinesRequestTransformer
{
    public function transform(string $countryCode): TopHeadlinesRequest
    {
        return new TopHeadlinesRequest($countryCode);
    }
}
