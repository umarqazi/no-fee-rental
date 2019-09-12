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

// Real Time notifications Route
Broadcast::channel('notification-channel.{id}', function(){
    return true;
});

// Real Time Chat Broadcaster Route
Broadcast::channel('messaging-channel.{id}', function() {
    return true;
});
