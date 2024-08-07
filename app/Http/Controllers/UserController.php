<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function profileSettings()
    {
        return Inertia::render('Auth/ProfileSettings');
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
}
