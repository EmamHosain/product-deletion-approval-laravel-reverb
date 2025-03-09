<?php

use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});



Broadcast::channel('admin-notification-channel.{user_id}', function (User $user, $user_id) {
    return (int) $user->id === (int) $user_id;
});

// product delete channel
Broadcast::channel('product-delete-channel.{user_id}', function (User $user, $user_id) {
    return (int) $user->id === (int) $user_id;
});
