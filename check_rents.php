<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$rents = \App\Models\Rent::all();
echo "Total Rents: " . count($rents) . "\n";
foreach ($rents as $rent) {
    echo "Rent ID: " . $rent->id . ", Status: " . $rent->status . ", Start: " . $rent->start_date . ", End: " . $rent->end_date . "\n";
    $items = $rent->items;
    echo "  Items: " . count($items) . "\n";
    foreach ($items as $item) {
        echo "    - Equipment ID: " . $item->equipment_id . ", Qty: " . $item->quantity . "\n";
    }
}
?>
