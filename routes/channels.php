<?php

use Illuminate\Support\Facades\Broadcast;

// Public channels - no authentication required
Broadcast::channel('presence.admin', function () {
    return true; // Allow all for now
});

Broadcast::channel('presence.customer', function () {
    return true; // Allow all for now
});