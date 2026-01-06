<?php
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Clear all online status
\App\Models\User::query()->update(['is_online' => false]);

echo "All users set to offline.\n";