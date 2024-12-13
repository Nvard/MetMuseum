<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use GuzzleHttp\Promise\Utils;

class MetMuseumController extends Controller
{
    private $baseUrl = 'https://collectionapi.metmuseum.org/public/collection/v1';

    public function getDepartments()
    {
        $departments = Cache::get('departments');
        if (!$departments) {
            // If not cached, make the request
            $response = Http::get("{$this->baseUrl}/departments");

            if ($response->successful()) {
                $departments = $response->json();

                // Cache the response for 60 minutes
                Cache::put('departments', $departments, now()->addMinutes(60));
            } else {
                return response()->json(['error' => 'Failed to fetch departments'], 500);
            }
        }

        return response()->json($departments);
    }

    public function searchArtworks(Request $request)
    {
        $departmentId = $request->query('departmentId');
        $query = $request->query('query');

        $cacheKey = "search_{$departmentId}_{$query}";
        $artworks = Cache::get($cacheKey);

        if (!$artworks) {
            $searchResponse = Http::get("{$this->baseUrl}/search", [
                'departmentId' => $departmentId,
                'q' => $query,
            ]);

            $objectIds = $searchResponse->json()['objectIDs'] ?? [];
            $objectIds = array_slice($objectIds, 0, 10); // limit the number of object IDs

            $promises = [];
            foreach ($objectIds as $id) {
                $promises[] = Http::async()->get("{$this->baseUrl}/objects/{$id}");
            }

            $responses = Utils::settle($promises)->wait();

            $artworks = [];
            foreach ($responses as $response) {
                if ($response['state'] === 'fulfilled') {
                    $artworks[] = $response['value']->json();
                }
            }

            Cache::put($cacheKey, $artworks, now()->addMinutes(10));  // Cache for 10 minutes
        }

        return response()->json($artworks);
    }
}
