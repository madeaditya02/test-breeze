<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Notifications\InvitePlan;
use App\Http\Controllers\Controller;

class InvitationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications()->where('type', InvitePlan::class)->with(['plan', 'sender', 'plan.activities'])->latest('updated_at')->get();
        // dd($notifications);
        return Inertia::render('Invitations', ['notifications' => $notifications]);
    }
}
