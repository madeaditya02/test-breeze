<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdateActivity implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $activities;
    public $plan_id;
    /**
     * Create a new event instance.
     */
    public function __construct($activities, $plan_id)
    {
        $this->activities = $activities;
        $this->plan_id = $plan_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        // error_log($this->activities[0]['plan_id']);
        return [
            // new Channel('activities.'.$this->plan_id),
            new PresenceChannel('chat.'.$this->plan_id),
        ];
    }
}
