<?php

namespace App\PublicDto\GeoData;

class GeoDataResponse
{
    private string $status;
    private string $countryCode;
    private string $query;
    private string $country;

    public function __construct(
        string $status,
        string $countryCode,
        string $query,
        string $country
    ) {
        $this->status = $status;
        $this->countryCode = $countryCode;
        $this->query = $query;
        $this->country = $country;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    public function getQuery(): string
    {
        return $this->query;
    }

    public function getCountry(): string
    {
        return $this->country;
    }
}
