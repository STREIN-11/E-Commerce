<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('presence.admin', function ($user) {
    if ($user->type === 'admin') {
        return ['id' => $user->id, 'name' => $user->name, 'type' => $user->type];
    }
});

Broadcast::channel('presence.customer', function ($user) {
    if ($user->type === 'customer') {
        return ['id' => $user->id, 'name' => $user->name, 'type' => $user->type];
    }
});