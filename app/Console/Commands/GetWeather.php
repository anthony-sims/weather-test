<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use RakibDevs\Weather\Weather;

class GetWeather extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-weather';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $location = 'Perth';
        $wt = new Weather();

        $current = $wt->getCurrentByCity($location);
        $this->info('Current Weather in ' . $location . ' is ' . $current->weather[0]->description);
    }
}
