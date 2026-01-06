<?php
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Reset auto-increment for products table
DB::statement('DELETE FROM sqlite_sequence WHERE name="products"');

echo "Product ID sequence reset.\n";