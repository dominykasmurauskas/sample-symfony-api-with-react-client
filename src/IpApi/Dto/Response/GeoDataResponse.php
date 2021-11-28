<?php

namespace App\IpApi\Dto\Response;

class GeoDataResponse
{
    private string $status;
    private string $country;
    private string $countryCode;
    private string $region;
    private string $regionName;
    private string $city;
    private string $query;

    public function __construct(
        string $status,
        string $country,
        string $countryCode,
        string $region,
        string $regionName,
        string $city,
        string $query
    ) {
        $this->status = $status;
        $this->country = $country;
        $this->countryCode = $countryCode;
        $this->region = $region;
        $this->regionName = $regionName;
        $this->city = $city;
        $this->query = $query;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    public function getRegion(): string
    {
        return $this->region;
    }

    public function getRegionName(): string
    {
        return $this->regionName;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getQuery(): string
    {
        return $this->query;
    }
}
