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
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvitationController;


Route::get('/', [HomeController::class, 'index']);
Route::get('/stories', [StoryController::class, 'index'])->name('stories');
Route::get('/stories/{story:slug}', [StoryController::class, 'show']);
Route::get('/explore', [PlaceController::class, 'guest'])->name('explore-guest');
Route::get('/@{user:username}', [UserController::class, 'profile']);
    
Route::middleware(['auth', 'verified'])->group(function () {
    Route::name('profile.')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('destroy');
    });


    Route::get('/plans', function () {
        return Inertia::render('Rooms', ['plans' => Plan::all()]);
    });
    Route::get('/plans/{plan:id}', function (Plan $plan) {
        // broadcast(new OnlineRoom($id))->toOthers();
        $plan->load('activities');
        return Inertia::render('OnlineRoom', ['plan' => $plan]);
    });

    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/explore', [PlaceController::class, 'explore'])->name('explore');
        Route::get('/stories', [StoryController::class, 'dashboard'])->name('dashboard-stories');
        Route::delete('/stories/{id}', [StoryController::class, 'destroy'])->name('delete-story');
        Route::get('/invitations', [InvitationController::class, 'index'])->name('invitations');
        Route::get('/account-settings', [UserController::class, 'accountSettings'])->name('account-settings');
        Route::post('/account-settings', [UserController::class, 'submitSettings']);
        Route::get('/profile-settings', [UserController::class, 'profileSettings'])->name('profile-settings');
        Route::post('/profile-settings', [UserController::class, 'updateProfile']);
        Route::resource('/plans/{plan:id}/activities', ActivityController::class);
        Route::get('/activities/{plan:public_id}', [PlanController::class, 'getActivities'])->name('get-activities');

        Route::get('/plans', [PlanController::class, 'index'])->name('plan.index');
        Route::get('/plan/{plan:public_id}', [PlanController::class, 'show'])->name('plan.detail');
        Route::resource('plan', PlanController::class)->only(['store', 'update', 'destroy']);
        Route::name('plan.')->group(function () {
            Route::put('/plan/{plan:public_id}/extend', [PlanController::class, 'extendPlan'])->name('extend');
            Route::get('/plans/{plan:public_id}/join', [PlanController::class, 'join'])->name('join');
            Route::post('/plans/{plan:public_id}/invite', [PlanController::class, 'invite'])->name('invite');
            Route::get('/plans/{plan:public_id}/story', [StoryController::class, 'create'])->name('story');
            Route::post('/plans/{plan:public_id}/story', [StoryController::class, 'store'])->name('publish-story');
        });
    });
    Route::post('/upload-image-body', [StoryController::class, 'uploadImageBody']);
    Route::get('/search-users', [UserController::class, 'searchUsers']);
    Route::post('/users/{user}/follow', [UserController::class, 'follow']);
    Route::post('/users/{user}/follower', [UserController::class, 'getFollower']);
    Route::post('/users/{user}/following', [UserController::class, 'getFollowing']);
});

Route::get('/search/{search}', [PlaceController::class, 'search']);
Route::resource('/activities', ActivityController::class);
require __DIR__ . '/auth.php';