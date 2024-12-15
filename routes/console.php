<?php

use App\Console\Commands\UpdateWeather;
use Illuminate\Support\Facades\Schedule;

Schedule::command(UpdateWeather::class, ['Perth'])->everyFifteenMinutes();