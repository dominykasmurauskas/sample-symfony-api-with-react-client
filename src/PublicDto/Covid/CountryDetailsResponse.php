<?php

namespace App\PublicDto\Covid;

class CountryDetailsResponse
{
    private string $from;
    private string $to;

    /**
     * @var DayStatistics[]
     */
    private array $data;

    /**
     * @param DayStatistics[] $data
     */
    public function __construct(string $from, string $to, array $data)
    {
        $this->from = $from;
        $this->to = $to;
        $this->data = $data;
    }

    public function getFrom(): string
    {
        return $this->from;
    }

    public function getTo(): string
    {
        return $this->to;
    }

    /**
     * @return DayStatistics[]
     */
    public function getData(): array
    {
        return $this->data;
    }
}
