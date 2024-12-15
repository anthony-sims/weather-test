<?php

declare(strict_types=1);

namespace App\Services;

use App\Facades\Weather;
use App\Traits\Newable;
use Illuminate\Support\Facades\Cache;

class WeatherService
{
    use Newable;

    public function storeToCacheByLocation(string $location): void
    {
        $time = 60 * 15; // 15 minutes
        $wt = Weather::getCurrentByCity($location);
        Cache::put("weather-$location", $wt, $time);
    }

    public function retreiveFromCacheByLocation(string $location): mixed
    {
        $time = 60 * 15; // 15 minutes
        $wt = Cache::remember("weather-$location", $time, fn() => Weather::getCurrentByCity($location));
        
        return $wt;
    }
}
