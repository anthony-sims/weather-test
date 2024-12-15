<?php

declare(strict_types=1);

namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use RakibDevs\Weather\Weather as WeatherAPI;

class Weather extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return WeatherAPI::class;
    }
}
