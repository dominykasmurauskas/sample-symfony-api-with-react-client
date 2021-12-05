<?php

namespace App\PublicDto\Covid;

class DayStatistics
{
    private int $confirmed;
    private int $deaths;
    private string $date;

    public function __construct(int $confirmed, int $deaths, string $date)
    {
        $this->confirmed = $confirmed;
        $this->deaths = $deaths;
        $this->date = $date;
    }

    public function getConfirmed(): int
    {
        return $this->confirmed;
    }

    public function getDeaths(): int
    {
        return $this->deaths;
    }

    public function getDate(): string
    {
        return $this->date;
    }
}
