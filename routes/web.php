<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ActivityController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Events\OnlineStatus;
use App\Models\Plan;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/plans', function () {
        return Inertia::render('Rooms', ['plans' => Plan::all()]);
    });
    Route::get('/plans/{plan:id}', function (Plan $plan) {
        // broadcast(new OnlineRoom($id))->toOthers();
        $plan->load('activities');
        return Inertia::render('OnlineRoom', ['plan' => $plan]);
    });

    Route::get('/dashboard', function () {
        return Inertia::render('MyDashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');
    Route::get('/dashboard/explore', function () {
        return Inertia::render('Explore');
    })->middleware(['auth', 'verified'])->name('explore');
    Route::get('/dashboard/plans', function () {
        return Inertia::render('Plans');
    })->middleware(['auth', 'verified'])->name('plans');
    Route::get('/dashboard/plans/{id}', function () {
        return Inertia::render('Plan');
    })->middleware(['auth', 'verified'])->name('plans');
    Route::get('/dashboard/invitations', function () {
        return Inertia::render('Invitations');
    })->middleware(['auth', 'verified'])->name('invittions');
});

Route::resource('/activities', ActivityController::class);

require __DIR__.'/auth.php';
