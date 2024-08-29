<?php

use App\Models\Plan;
use Inertia\Inertia;
use App\Events\OnlineStatus;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlanController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\InvitationController;

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get('/', [HomeController::class, 'index']);
Route::get('/stories', [StoryController::class, 'index']);
Route::get('/stories/{story:slug}', [StoryController::class, 'show']);
Route::get('/@{user:username}', [UserController::class, 'profile']);

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
        Route::get('/dashboard/plans/{plan:public_id}', [PlanController::class, 'show'])->name('detail');
        Route::get('/dashboard/plans/{plan:public_id}/join', [PlanController::class, 'join'])->name('join');
        Route::post('/dashboard/plans/{plan:public_id}/invite', [PlanController::class, 'invite'])->name('invite');
        Route::get('/dashboard/plans/{plan:public_id}/story', [StoryController::class, 'create'])->name('story');
        Route::post('/dashboard/plans/{plan:public_id}/story', [StoryController::class, 'store'])->name('publish-story');
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
        })->with(['activities', 'activities.place', 'users'])->get()]);
    })->name('dashboard');
    Route::get('/dashboard/explore', [PlaceController::class, 'explore'])->name('explore');
    Route::get('/dashboard/stories', [StoryController::class, 'dashboard'])->name('dashboard-stories');
    Route::delete('/dashboard/stories/{id}', [StoryController::class, 'destroy'])->name('delete-story');
    Route::get('/dashboard/invitations', [InvitationController::class, 'index'])->name('invitations');
    Route::get('/dashboard/account-settings', [UserController::class, 'accountSettings'])->name('account-settings');
    Route::post('/dashboard/account-settings', [UserController::class, 'submitSettings']);
    Route::get('/dashboard/profile-settings', [UserController::class, 'profileSettings'])->name('profile-settings');
    Route::post('/dashboard/profile-settings', [UserController::class, 'updateProfile']);
    Route::resource('/dashboard/plans/{plan:id}/activities', ActivityController::class);
    Route::post('/upload-image-body', [StoryController::class, 'uploadImageBody']);
    Route::post('/search-users', [UserController::class, 'searchUsers']);
    Route::post('/users/{user}/follow', [UserController::class, 'follow']);
    Route::post('/users/{user}/follower', [UserController::class, 'getFollower']);
    Route::post('/users/{user}/following', [UserController::class, 'getFollowing']);
});

Route::get('/search/{search}', [PlaceController::class, 'search']);
Route::resource('/activities', ActivityController::class);
require __DIR__ . '/auth.php';