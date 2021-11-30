<?php

namespace App\CovidApi\Transformer;

use App\CovidApi\Dto\Response\DayStatistics as InternalDayStatistics;
use App\PublicDto\Covid\CountryDetailsResponse;
use App\PublicDto\Covid\DayStatistics;

class CountryDetailsResponseTransformer
{
    /**
     * @param InternalDayStatistics[] $internalDayStatistics
     */
    public function transform(array $internalDayStatistics, \DateTime $from, \DateTime $to): CountryDetailsResponse
    {
        return new CountryDetailsResponse(
            $from->format('Y-m-d'),
            $to->format('Y-m-d'),
            $this->transformDayStatistics($internalDayStatistics)
        );
    }

    /**
     * @param InternalDayStatistics[] $internalDayStatistics
     *
     * @return DayStatistics[]
     */
    public function transformDayStatistics(array $internalDayStatistics): array
    {
        $result = [];
        foreach ($internalDayStatistics as $internalDayStatistic) {
            $result[] = new DayStatistics(
                $internalDayStatistic->getConfirmed(),
                $internalDayStatistic->getDeaths(),
                $internalDayStatistic->getActive(),
                (new \DateTime($internalDayStatistic->getDate()))->format('Y-m-d')
            );
        }

        return $result;
    }
}
