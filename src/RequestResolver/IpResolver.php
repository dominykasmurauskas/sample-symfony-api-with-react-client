<?php

namespace App\RequestResolver;

use Symfony\Component\HttpFoundation\HeaderUtils;
use Symfony\Component\HttpFoundation\Request;

class IpResolver
{
    private const HEADER_USER_IP = 'X-User-IP';

    public function resolve(Request $request): string
    {
        $ips = $this->getHeaderValues($request);
        $ips = $this->normalizeAndFilterIps($ips);

        return reset($ips) ?: '';
    }

    private function getHeaderValues(Request $request): array
    {
        $ips = [];
        if ($request->headers->has(self::HEADER_USER_IP)) {
            $headerValue = $request->headers->get(self::HEADER_USER_IP);
            $parts = HeaderUtils::split($headerValue, ',');
            foreach($parts as $subPart) {
                $ips[] = $subPart;
            }
        }

        return $ips;
    }

    private function normalizeAndFilterIps(array $ips): array
    {
        if (!$ips) {
            return [];
        }

        foreach ($ips as $key => $ip) {
            if (strpos($ip, '.')) { //strip :port from ipv4
                $i = strpos($ip, ':');
                if ($i) {
                    $ips[$key] = $ip = substr($ip, 0, $i);
                }
            } elseif (strpos($ip, '[') === 0) { //strip :port from ipv6
                $i = strpos($ip, ']', 1);
                $ips[$key] = $ip = substr($ip, 1, $i - 1);
            }

            if (!filter_var($ip, \FILTER_VALIDATE_IP, \FILTER_FLAG_NO_RES_RANGE | \FILTER_FLAG_NO_PRIV_RANGE)) {
                unset($ips[$key]);
            }
        }

        return $ips;
    }
}
