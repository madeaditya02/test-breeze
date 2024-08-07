<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class PlaceController extends Controller
{
    public function explore(Request $request)
    {
        return Inertia::render('Explore');
    }
    public function search(Request $request, string $search)
    {
        $response = Http::get("https://maps.googleapis.com/maps/api/place/findplacefromtext/json", [
            'input' => $search,
            'fields' => 'formatted_address,name,rating,opening_hours,photo,place_id',
            'inputtype' => 'textquery',
            'key' => env('MAPS_API_KEY'),
        ]);
        dd($response->json());
    }
}