<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function profile(User $user)
    {
        return Inertia::render('Profile', [
            'user' => $user->load('stories'),
            'followed' => $user->followers()->where('follower_id', auth()->id())->count() > 0
        ]);
    }
    public function profileSettings()
    {
        return Inertia::render('Auth/ProfileSettings');
    }
    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $data = $request->validate([
            'name' => 'required|min:2',
            'username' => [
                'required',
                Rule::unique('users')->ignore($user->id)
            ],
        ]);
        $picture = $request->file('pictureFile');
        if ($picture) {
            $extension = 'png';
            Storage::delete('public/user/' . collect(str($user->profile_picture)->explode('/'))->last());
            $time = time();
            $picture->storeAs('public/user', $user->username.'-'.$time.'.'.$extension);
            $user->profile_picture = asset("storage/user/$user->username-$time.$extension");
        }
        $user->name = $data['name'];
        $user->username = $data['username'];
        $user->save();
        return redirect('/dashboard/profile-settings')->with('alert', ['success', 'Update Profile', 'Profile has been updated']);
    }
    public function accountSettings()
    {
        return Inertia::render('Auth/AccountSettings');
    }
    public function submitSettings(Request $request)
    {
        if ($request->type == 'change-password') {
            $validated = $request->validate([
                'oldPassword' => 'required|current_password',
                'newPassword' => 'required|min:8|confirmed',
            ], [], [
                'oldPassword' => 'old password',
                'newPassword' => 'new password',
            ]);
            User::whereId(auth()->id())->update([
                'password' => Hash::make($validated['newPassword'])
            ]);
            return redirect('/dashboard/account-settings')->with('alert', ['success', 'Update Password', 'Password has been changed successfully']);
        } else if ($request->type == 'delete-account') {
            $validated = $request->validate([
                'verify' => 'required|in:delete my account',
                'password' => 'required|current_password',
            ], ['in' => 'You must type \'delete my account\'']);
            // $user = auth()->user();
            // $user->posts()->forceDelete();
            // $user->bookmarks()->delete();
            // $user->followers()->delete();
            // $user->tags()->delete();
            // $user->likes()->delete();
            // $user->comments()->delete();
            User::where('id', auth()->id())->delete();
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/')->with('alert', ['success', 'Delete Account', 'Your account has been deleted permanently']);
        }
    }

    public function searchUsers(Request $request)
    {
        $q = $request->input('q');
        return User::whereLike('name', "%$q%")->orWhereLike('username', "%$q%")->orWhereLike('email', "%$q%")->get(['id', 'name', 'email', 'profile_picture']);
    }
    
    public function follow(User $user, Request $request)
    {
        $follow = $request->input('follow');
        if ($follow && $user->followers()->where('follower_id', auth()->id())->count() == 0) {
            auth()->user()->following()->attach($user->id);
        } else {
            auth()->user()->following()->detach($user->id);
        }
    }
    
    public function getFollower(User $user)
    {
        $follower = $user->followers()->with(['followers', 'following'])->get()->map(fn($user) => [
            'user' => $user,
            'followed' => $user->followed(),
        ]);
        return $follower;
    }
    
    public function getFollowing(User $user)
    {
        $follower = $user->following()->with(['followers', 'following'])->get()->map(fn($user) => [
            'user' => $user,
            'followed' => $user->followed(),
        ]);
        return $follower;
    }
}
