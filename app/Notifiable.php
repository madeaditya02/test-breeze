<?php

namespace App;

use App\Models\Notification;
use Illuminate\Notifications\Notifiable as BaseNotifiable;

trait Notifiable
{
  use BaseNotifiable;

  public function notifications()
  {
      return $this->morphMany(Notification::class, 'notifiable')->orderBy('created_at', 'desc');
  }
}