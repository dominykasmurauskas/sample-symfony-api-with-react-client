<?php

namespace App\IpApi\Dto\Request;

class GeoDataRequest
{
    private string $ip;

    public function __construct(string $ip)
    {
        $this->ip = $ip;
    }

    public function getIp(): string
    {
        return $this->ip;
    }
}
