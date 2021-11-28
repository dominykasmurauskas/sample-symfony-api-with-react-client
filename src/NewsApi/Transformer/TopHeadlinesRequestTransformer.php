<?php

namespace App\NewsApi\Transformer;

use App\NewsApi\Dto\Request\TopHeadlinesRequest;

class TopHeadlinesRequestTransformer
{
    public function transform(string $countryCode): TopHeadlinesRequest
    {
        return new TopHeadlinesRequest($countryCode);
    }
}
