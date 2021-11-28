<?php

namespace App\NewsApi\Transformer;

use App\NewsApi\Dto\Response\Article as InternalArticle;
use App\NewsApi\Dto\Response\TopHeadlinesResponse as TopHeadlinesInternalResponse;
use App\PublicDto\News\Article;
use App\PublicDto\News\TopHeadlinesResponse;

class TopHeadlinesResponseTransformer
{
    public function transform(TopHeadlinesInternalResponse $internalResponse): TopHeadlinesResponse
    {
        return new TopHeadlinesResponse(
            $internalResponse->getTotalResults(),
            $this->transformArticles($internalResponse->getArticles())
        );
    }

    /**
     * @param InternalArticle[] $internalArticles
     *
     * @return Article[]
     */
    private function transformArticles(array $internalArticles): array
    {
        $result = [];
        foreach ($internalArticles as $internalArticle) {
            $result[] = new Article(
                $internalArticle->getAuthor(),
                $internalArticle->getTitle(),
                $internalArticle->getDescription(),
                $internalArticle->getUrl(),
                $internalArticle->getUrlToImage(),
                $internalArticle->getPublishedAt()
            );
        }

        return $result;
    }
}
