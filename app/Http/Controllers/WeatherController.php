<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\WeatherService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): JsonResponse
    {
        $location = 'Perth';
        $weatherService = WeatherService::new();

        try {
            $wt = $weatherService->retreiveFromCacheByLocation($location);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }

        return response()->json($wt);
    }
}
