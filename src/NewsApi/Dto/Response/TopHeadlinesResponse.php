<?php

namespace App\NewsApi\Dto\Response;

class TopHeadlinesResponse
{
    private string $status;
    private int $totalResults;

    /**
     * @var Article[]
     */
    private array $articles;

    /**
     * @param Article[] $articles
     */
    public function __construct(
        string $status,
        int $totalResults,
        array $articles
    ) {
        $this->status = $status;
        $this->totalResults = $totalResults;
        $this->articles = $articles;
    }

    public function getStatus(): string
    {
        return $this->status;
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
