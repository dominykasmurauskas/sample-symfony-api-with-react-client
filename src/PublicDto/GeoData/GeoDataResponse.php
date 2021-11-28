<?php

namespace App\PublicDto\GeoData;

class GeoDataResponse
{
    private string $status;
    private string $countryCode;
    private string $query;

    public function __construct(
        string $status,
        string $countryCode,
        string $query
    ) {
        $this->status = $status;
        $this->countryCode = $countryCode;
        $this->query = $query;
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
}
