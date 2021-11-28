<?php

namespace App\CovidApi\Transformer;

use App\CovidApi\Dto\Request\CountryDetailsRequest as CountryDetailsInternalRequest;
use App\PublicDto\Covid\CountryDetailsRequest as CountryDetailsPublicRequest;

class CountryDetailsRequestTransformer
{
    public function transform(CountryDetailsPublicRequest $countryDetailsRequest): CountryDetailsInternalRequest
    {
        $from = $countryDetailsRequest->getFrom();
        $to = $countryDetailsRequest->getTo();

        $from = $from ? new \DateTime($from) : (new \DateTime())->modify('-1 week');
        $to = $to ? new \DateTime($to) : new \DateTime();

        return new CountryDetailsInternalRequest(
            $countryDetailsRequest->getCountrySlug(),
            $from,
            $to
        );
    }
}
