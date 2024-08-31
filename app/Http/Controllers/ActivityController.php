<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Place;
use App\Models\Activity;
use Illuminate\Http\Request;
use App\Events\UpdateActivity;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

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
    public function store(Plan $plan, Request $request)
    {
        if (!Gate::allows('edit-plan', $plan)) {
            abort(403);
        }
        $data = $request->input('data');
        $activities = $request->input('activities');
        $newActivity = [
            'plan_id' => $plan->id,
            'place_id' => $data['place']['id'],
            'time' => $data['time']
        ];
        Place::upsert([
            'id' => $data['place']['id'],
            'name' => $data['place']['displayName']['text'],
            'types' => json_encode($data['place']['types']),
            'address' => $data['place']['formattedAddress'],
            'latitude' => $data['place']['location']['latitude'],
            'longitude' => $data['place']['location']['longitude'],
            'rating' => $data['place']['rating'],
            'url' => $data['place']['googleMapsUri'],
            'summary' => $data['place']['editorialSummary']['text'] ?? '',
            'photo' => $data['place']['photos'][0]['name'],
        ], ['id']);

        Activity::create($newActivity);
        $updated = $plan->activities()->with('place')->get();
        broadcast(new UpdateActivity($updated, $plan->id))->toOthers();

        return back();
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
    public function update(Plan $plan, Activity $activity, Request $request)
    {
        if ($request['place'] != null) {
            Place::upsert([
                'id' => $request['place']['id'],
                'name' => $request['place']['displayName']['text'],
                'types' => json_encode($request['place']['types']),
                'address' => $request['place']['formattedAddress'],
                'latitude' => $request['place']['location']['latitude'],
                'longitude' => $request['place']['location']['longitude'],
                'rating' => $request['place']['rating'],
                'url' => $request['place']['googleMapsUri'],
                'summary' => $request['place']['editorialSummary']['text'] ?? '',
                'photo' => $request['place']['photos'][0]['name'],
            ], ['id']);
        }
        $updatedActivity = Activity::find($activity->id);
        $updatedActivity->time = $request->time;
        $updatedActivity->place_id = $request['place']['id'];

        $updatedActivity->save();
        return response()->json(
            [
                'message' => 'Success'
            ],
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan $plan, Activity $activity, Request $request)
    {
        if (!Gate::allows('edit-plan', $plan)) {
            abort(403);
        }
        $data = $request->all();
        $activity->delete();
        broadcast(new UpdateActivity($data['activities'], $plan->id))->toOthers();
        return response()->json($data['activities']);
    }
}