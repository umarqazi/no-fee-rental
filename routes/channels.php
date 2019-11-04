<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

use Illuminate\Support\Facades\Broadcast;

// Notification Broadcasting Channel
Broadcast::channel('notification-channel.{id}', function(){
    return true;
});

// Chat Broadcasting Channel
Broadcast::channel('messaging-channel.{id}', function() {
    return true;
});

// Save Search List Broadcasting Channel
Broadcast::channel('listing-channel.{id}', function() {
    return true;
});
