<?php

namespace App\PublicDto\Covid;

class CountryDetailsRequest
{
    private string $countrySlug;
    private ?string $from;
    private ?string $to;

    public function __construct(?string $from, ?string $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public function setCountrySlug(string $countrySlug): self
    {
        $this->countrySlug = $countrySlug;

        return $this;
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
