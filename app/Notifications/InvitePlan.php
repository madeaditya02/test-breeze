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
        return [CustomDbChannel::class];
        // return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Accept Invite', url('/'))
            ->line('Thank you for using our application!');
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
            'plan_start' => $this->plan->start_date,
            'plan_end' => $this->plan->end_date
        ];
    }
}
