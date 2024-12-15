<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Jobs\WeatherJob;
use Illuminate\Console\Command;

class UpdateWeather extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-weather {location}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dispatch job to update weather for a given location';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        WeatherJob::dispatch($this->argument('location'));
    }
}
