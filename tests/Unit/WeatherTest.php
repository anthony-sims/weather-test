<?php

namespace Tests\Unit;

use App\Facades\Weather;
use Tests\TestCase;

class WeatherTest extends TestCase
{
    /**
     * Tests weather API endpoint
     */
    public function test_weather_api_endpoint(): void
    {
        Weather::shouldReceive('getCurrentByCity')
            ->once()
            ->with('Perth')
            ->andReturn([
                'weather' => [
                    [
                        'description' => 'Clear sky'
                    ]
                ]
            ]);
        $response = $this->get('/api/weather');
        $response->assertStatus(200);
    }
}
