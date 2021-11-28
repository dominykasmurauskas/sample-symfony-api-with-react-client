<?php

namespace App\PublicDto\Covid;

class CountryDetailsRequest
{
    private string $countrySlug;
    private ?string $from;
    private ?string $to;

    public function __construct(string $countrySlug, ?string $from, ?string $to)
    {
        $this->countrySlug = $countrySlug;
        $this->from = $from;
        $this->to = $to;
    }

    public function getCountrySlug(): string
    {
        return $this->countrySlug;
    }

    public function getFrom(): ?string
    {
        return $this->from;
    }

    public function getTo(): ?string
    {
        return $this->to;
    }
}
