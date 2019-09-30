<?php

use App\Post;

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

Broadcast::channel('User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('post-{id}', function ($user, $id) {
    
    return $user->id == Post::find($id)->author_id;
});

