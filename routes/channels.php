<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
Broadcast::channel('test-channel', function ($user) {
    return $user;
});
// Broadcast::channel('activities.{roomId}', function ($user, $roomId) {
//     return $user;
// });
Broadcast::channel('plan.{roomId}', function ($user, $roomId) {
    return ['id' => $user->id, 'name' => $user->name, 'profile_picture' => $user->profile_picture];
    if ($roomId == 'abcd') {
    }
});