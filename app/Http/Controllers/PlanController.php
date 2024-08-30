<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Story;
use App\Models\Activity;
use Illuminate\Http\Request;
use App\Notifications\InvitePlan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Notification;
use Throwable;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(auth()->user()->plans()->wherePivotNotNull('accepted_at')->with(['activities', 'users'])->get());
        return Inertia::render('Plans', ['plans' => Auth::user()->plans()->wherePivotNotNull('accepted_at')->with(['activities', 'users', 'activities.place'])->get()]);
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
        try {
            $createdPlan = Plan::create(
                [
                    'name' => $request->name,
                    'start_date' => date("Y-m-d", strtotime($request->startDate)),
                    'end_date' => date("Y-m-d", strtotime($request->endDate)),
                ]
            );
            $createdPlan->users()->attach($request->userId, ['accepted_at' => date("Y-m-d H:i:s")]);

            return to_route('plan.showAll');
        } catch (Throwable $e) {
            return response()->json(
                [
                    'message' => 'Something went wrong.' . $e->getMessage(),
                ],
                400
            );
        }
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
        }, 'activities.place']);
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
            return redirect('/dashboard/plans/' . $plan->id)->with('alert', ['success', 'Join Plan', 'You successfully joined plan']);
        } else {
            abort(403);
        }
    }
    public function invite(Plan $plan, Request $request)
    {
        if (Gate::allows('invite-delete-plan', $plan)) {
            $user_id = $request->input('user');
            $userexist = $plan->users()->wherePivot('user_id', $user_id)->first();
            if (!$userexist) {
                $user = User::find($user_id);
                $user->notify(new InvitePlan($plan, auth()->user()));
                // Notification::send($users, new InvitePlan($plan, auth()->user()));
                $plan->users()->attach($user, ['role' => 'Member']);
            } else {
                // $userexist->notifications()->where('plan_id', $plan)->latest()->first()->update(['updated_at', now()]);
            }
        }
    }
}
