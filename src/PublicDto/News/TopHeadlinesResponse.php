<?php

namespace App\PublicDto\News;

class TopHeadlinesResponse
{
    private int $totalResults;

    /**
     * @var Article[]
     */
    private array $articles;

    /**
     * @param Article[] $articles
     */
    public function __construct(
        int $totalResults,
        array $articles
    ) {
        $this->totalResults = $totalResults;
        $this->articles = $articles;
    }

    public function getTotalResults(): int
    {
        return $this->totalResults;
    }

    public function getArticles(): array
    {
        return $this->articles;
    }
}