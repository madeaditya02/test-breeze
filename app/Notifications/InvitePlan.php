<?php

namespace App\Notifications;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Bus\Queueable;
use App\Notifications\CustomDbChannel;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class InvitePlan extends Notification
{
    use Queueable;

    public $plan;
    /**
     * Create a new notification instance.
     */
    public function __construct(Plan $plan, User $user)
    {
        $this->plan = $plan;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', CustomDbChannel::class];
        // return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $name = $notifiable->name;
        $plan_id = $this->plan->id;
        return (new MailMessage)
                    ->line("Hello $name, you have been invited to collaborate on travel planning in our Travel Planner app. Click the button below to accept the invitation.")
                    ->action('Accept Invite', url("/dashboard/plans/$plan_id/join"))
                    ->line('If you did not create an account, no further action is required. Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array
    {
        $this->plan->load('activities');
        return [
            'plan_id' => $this->plan->id,
            'plan_name' => $this->plan->name,
            'sender_id' => $this->user->id,
            'plan_start' => $this->plan->activities[0]->time,
            'plan_end' => $this->plan->activities[$this->plan->activities->count() - 1]->time
        ];
    }
}
