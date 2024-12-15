<?php

namespace App\Jobs;

use App\Services\WeatherService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class WeatherJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public string $location)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $service = WeatherService::new();
        $service->storeToCacheByLocation($this->location);
    }
}
