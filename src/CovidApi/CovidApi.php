<?php

namespace App\CovidApi;

use App\CovidApi\Client\Client;
use App\CovidApi\Transformer\CountryDetailsRequestTransformer;
use App\CovidApi\Transformer\CountryDetailsResponseTransformer;
use App\PublicDto\Covid\CountryDetailsRequest;
use App\PublicDto\Covid\CountryDetailsResponse;

class CovidApi
{
    private CountryDetailsRequestTransformer $countryDetailsRequestTransformer;
    private CountryDetailsResponseTransformer $countryDetailsResponseTransformer;
    private Client $apiClient;

    public function __construct(
        CountryDetailsRequestTransformer $countryDetailsRequestTransformer,
        CountryDetailsResponseTransformer $countryDetailsResponseTransformer,
        Client $apiClient
    ) {
        $this->countryDetailsRequestTransformer = $countryDetailsRequestTransformer;
        $this->countryDetailsResponseTransformer = $countryDetailsResponseTransformer;
        $this->apiClient = $apiClient;
    }

    public function getCountryDetails(CountryDetailsRequest $countryDetailsRequest): CountryDetailsResponse
    {
        $request = $this->countryDetailsRequestTransformer->transform($countryDetailsRequest);
        $response = $this->apiClient->getCountryDetails($request);

        return $this->countryDetailsResponseTransformer->transform($response, $request->getDateFrom(), $request->getDateTo());
    }
}
