<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InvitationController;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Events\OnlineStatus;
use App\Models\Plan;
use Inertia\Inertia;

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get('/', [HomeController::class, 'index']);

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::name('profile.')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('destroy');
    });

    Route::name('plan.')->group(function () {
        Route::get('/dashboard/plans', [PlanController::class, 'index'])->name('showAll');
        Route::post('/dashboard/plan', [PlanController::class, 'store'])->name('create');
        Route::get('/dashboard/plans/{plan:id}', [PlanController::class, 'show'])->name('detail');
        Route::get('/dashboard/plans/{plan:id}/join', [PlanController::class, 'join'])->name('join');
        Route::post('/dashboard/plans/{plan:id}/invite', [PlanController::class, 'invite'])->name('invite');
    });

    Route::get('/plans', function () {
        return Inertia::render('Rooms', ['plans' => Plan::all()]);
    });
    Route::get('/plans/{plan:id}', function (Plan $plan) {
        // broadcast(new OnlineRoom($id))->toOthers();
        $plan->load('activities');
        return Inertia::render('OnlineRoom', ['plan' => $plan]);
    });

    Route::get('/dashboard', function () {
        return Inertia::render('MyDashboard', ['plans' => auth()->user()->plans()->wherePivotNotNull('accepted_at')->whereHas('activities', function ($query) {
            $query->where('time', '>=', now()->startOfDay());
        })->with(['activities', 'users'])->get()]);
    })->name('dashboard');
    Route::get('/dashboard/explore', [PlaceController::class, 'explore'])->name('explore');
    Route::get('/dashboard/invitations', [InvitationController::class, 'index'])->name('invitations');
    Route::get('/dashboard/account-settings', [UserController::class, 'accountSettings'])->name('account-settings');
    Route::post('/dashboard/account-settings', [UserController::class, 'submitSettings']);
    Route::get('/dashboard/profile-settings', [UserController::class, 'profileSettings'])->name('profile-settings');
    Route::resource('/dashboard/plans/{plan:id}/activities', ActivityController::class);
    Route::post('/search-users', [UserController::class, 'searchUsers']);
});

Route::get('/search/{search}', [PlaceController::class, 'search']);
Route::resource('/activities', ActivityController::class);
require __DIR__ . '/auth.php';