<?php

namespace App\CovidApi\Dto\Response;

class DayStatistics
{
    private int $confirmed;
    private int $deaths;
    private int $active;
    private string $date;

    public function __construct(int $Confirmed, int $Deaths, int $Active, string $Date)
    {
        $this->confirmed = $Confirmed;
        $this->deaths = $Deaths;
        $this->active = $Active;
        $this->date = $Date;
    }

    public function getConfirmed(): int
    {
        return $this->confirmed;
    }

    public function getDeaths(): int
    {
        return $this->deaths;
    }

    public function getActive(): int
    {
        return $this->active;
    }

    public function getDate(): string
    {
        return $this->date;
    }
}
