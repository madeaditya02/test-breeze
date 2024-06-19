<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Events\UpdateActivity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $data = $request->input('data');
        $activities = $request->input('activities');
        array_push($activities, Activity::create($data));
        broadcast(new UpdateActivity($activities, $data['plan_id']))->toOthers();
        // UpdateActivity::dispatch($activities, $data['plan_id']);
        return response()->json($activities);
    }

    /**
     * Display the specified resource.
     */
    public function show(Activity $activity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activity $activity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Activity $activity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity, Request $request)
    {
        $data = $request->all();
        $activity->delete();
        broadcast(new UpdateActivity($data['activities'], $data['plan_id']))->toOthers();
        return response()->json($data['activities']);
    }
}
