<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Notifications\InvitePlan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Notification;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Plans', ['plans' => auth()->user()->plans()->wherePivotNotNull('accepted_at')->with('activities')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Plan $plan)
    {
        // dd($plan->users->contains('id', auth()->id()));
        if (!Gate::allows('edit-plan', $plan)) {
            abort(403);
        }
        $plan->load(['activities' => function ($query) {
            $query->orderBy('time', 'asc');
        }, 'users' => function ($query) {
            $query->wherePivotNotNull('accepted_at');
        }]);
        return Inertia::render('Plan', ['plan' => $plan]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function join(Plan $plan)
    {
        $user = $plan->users()->wherePivot('user_id', auth()->id())->first();
        if ($user) {
            DB::table('plan_user')->where('user_id', $user->id)->update(['accepted_at' => now()]);
            $user->notifications()->where('data->plan_id', $plan->id)->update(['read_at' => now()]);
            return redirect('/dashboard/plans/'.$plan->id)->with('alert', ['success', 'Join Plan', 'You successfully joined plan']);
        } else {
            abort(403);
        }
    }
    public function invite(Plan $plan, Request $request)
    {
        $user_id = $request->input('user');
        $userexist = $plan->users()->wherePivot('user_id', $user_id)->first();
        if (!$userexist) {
            $user = User::find($user_id);
            $user->notify(new InvitePlan($plan, auth()->user()));
            // Notification::send($users, new InvitePlan($plan, auth()->user()));
            $plan->users()->attach($user);
        } else {
            // $userexist->notifications()->where('plan_id', $plan)->latest()->first()->update(['updated_at', now()]);
        }
    }
}
