<?php

namespace App\News\Dto\Response;

class Article
{
    private ?string $author;
    private string $title;
    private ?string $description;
    private string $url;
    private ?string $urlToImage;
    private string $publishedAt;

    public function __construct(
        ?string $author,
        string $title,
        ?string $description,
        string $url,
        ?string $urlToImage,
        string $publishedAt
    ) {
        $this->author = $author;
        $this->title = $title;
        $this->description = $description;
        $this->url = $url;
        $this->urlToImage = $urlToImage;
        $this->publishedAt = $publishedAt;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getUrlToImage(): ?string
    {
        return $this->urlToImage;
    }

    public function getPublishedAt(): string
    {
        return $this->publishedAt;
    }
}
