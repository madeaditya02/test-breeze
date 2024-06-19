<?php

namespace App\Listeners;

use App\Events\PodcastProcessed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;

class SendPodcastNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PodcastProcessed $event): void
    {
        // User::create([
        //     'email' => $event->email,
        //     'name' => $event->name,
        //     'password' => 'Password'
        // ]);
    }
}
