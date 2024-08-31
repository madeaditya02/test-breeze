<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PlaceController extends Controller
{
    public function guest(Request $request)
    {
        return Inertia::render('Explore', ['provinces' => []]);
    }
    public function explore(Request $request)
    {
        $data = Activity::whereHas('plan', function($query) {
            return $query->whereHas('users', function($query) {
                return $query->where('users.id', auth()->id());
            });
        })->with('place')->get()->pluck('place')->flatten()->pluck('province')->unique()->take(3);
        // dd($data);
        return Inertia::render('DashboardExplore', ['provinces' => $data]);
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