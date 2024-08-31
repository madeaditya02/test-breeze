<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index() {
        $provinces = Activity::whereHas('plan', function($query) {
            return $query->whereHas('users', function($query) {
                return $query->where('users.id', auth()->id());
            });
        })->with('place')->get()->pluck('place')->flatten()->pluck('province')->unique()->take(3);
        $currentPlans = auth()->user()->plans()->wherePivotNotNull('accepted_at')->where('end_date', '>=', today())->with(['activities', 'activities.place', 'users'])->get();
        return Inertia::render('MyDashboard', ['provinces' => $provinces, 'plans' => $currentPlans]);
    }
}
