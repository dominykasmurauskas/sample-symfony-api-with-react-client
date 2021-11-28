<?php

namespace App\CovidApi\Dto\Request;

use DateTime;

class CountryDetailsRequest
{
    private string $countrySlug;
    private DateTime $dateFrom;
    private DateTime $dateTo;

    public function __construct(string $countrySlug, DateTime $dateFrom, DateTime $dateTo)
    {
        $this->countrySlug = $countrySlug;
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
    }

    public function getCountrySlug(): string
    {
        return $this->countrySlug;
    }

    public function getDateFrom(): DateTime
    {
        return $this->dateFrom;
    }

    public function getDateTo(): DateTime
    {
        return $this->dateTo;
    }
}
