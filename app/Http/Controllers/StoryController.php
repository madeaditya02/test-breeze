<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Inertia\Inertia;
use App\Models\Story;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Cviebrock\EloquentSluggable\Services\SlugService;

class StoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd(Story::latest()->get()->each(fn($story) => $story['body'] = Str::words($story['body'], 25))->all());
        // dd(str_replace("/<[^>]+>/g", '', "<p>Lorem <strong>ipsum</strong> dolor sit amet, <i>consectetur</i> adipisicing elit"));
        // dd(Story::with(['user', 'plan:id', 'plan.activities:id', 'plan.activities.place'])->latest()->get());
        // dd(auth()->user()->following()->with(['stories', 'stories.user'])->get()->pluck('stories')->flatten()->sortByDesc('created_at'));
        if ($request->input('tab') == 'following')
            return auth()->user()->following()->with(['stories', 'stories.user'])->get()->pluck('stories')->flatten()->sortByDesc('created_at');
        if ($request->input('tab') == 'recent')
            return Story::with(['user'])->latest()->get();
        $tab = auth()->check() ? auth()->user()->following()->count() > 0 ? 'following' : 'recent' : 'recent';
        return Inertia::render('Stories', [
            'stories' => $tab == 'recent' ? Story::with(['user'])->latest()->get() : null,
            'followingStories' => $tab == 'following' ? auth()->user()->following()->with(['stories', 'stories.user'])->get()->pluck('stories')->flatten()->sortByDesc('created_at') : null,
            'tab' => $tab
        ]);
    }
    
    /**
     * Display a listing of the resource in dashboard.
     */
    public function dashboard()
    {
        return Inertia::render('DashboardStories', ['stories' => auth()->user()->stories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Plan $plan)
    {
        if (!Gate::allows('edit-plan', $plan)) {
            abort(403);
        }
        $storyExist = $plan->stories()->where('user_id', auth()->id())->first();
        if ($storyExist) {
            return redirect("/stories/$storyExist->slug");
        }
        $plan->load(['activities', 'activities.place']);
        return Inertia::render('WriteStory', ['plan' => $plan]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Plan $plan, Request $request)
    {
        if (!Gate::allows('edit-plan', $plan)) {
            return abort(403);
        }
        $data = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
        $slug = SlugService::createSlug(Story::class, 'slug', $data['title']);
        $data['plan_id'] = $plan->id;
        $data['user_id'] = auth()->id();
        if ($request->file('picture')) {
            $extension = $request->file('picture')->getClientOriginalExtension();
            $request->file('picture')->storeAs('public/cover', $slug.'.'.$extension);
            $data['picture'] = asset("storage/cover/$slug.$extension");
        }
        // $data['pictureInBody'] = count($data['pictureInBody']) > 0 ? json_encode($data['pictureInBody']) : null;
        $story = Story::create($data);
        return redirect("/stories/$story->slug")->with('alert', ['success', 'Publish Blog', 'Blog has been published']);
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Story $story)
    {
        // dd($story->load('user:id,name,profile_picture'));
        return Inertia::render('Story', ['story' => $story->load('user:id,name,username,profile_picture')]);
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Story $story)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Story $story)
    {
        //
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Story::destroy($id);
        return redirect('/dashboard/stories')->with('alert', ['success', 'Delete Story', 'Story has been deleted']);
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function uploadImageBody(Request $request)
    {
        $slug = SlugService::createSlug(Story::class, 'slug', $request->input('title'));
        $data = [];
        if ($request->file('pictureInBody')) {
            foreach ($request->file('pictureInBody') as $i => $file) {
                $extension = $file->getClientOriginalExtension();
                $file->storeAs('public/bodyImage', "$slug-$i.$extension");
                array_push($data, asset("storage/bodyImage/$slug-$i.$extension"));
            }
            return response()->json($data);
        }
    }
}
