<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Carbon\Carbon;

$selectedDate = Carbon::parse('2025-12-18');
echo "Selected Date: " . $selectedDate->format('Y-m-d') . "\n\n";

// Test untuk equipment ID 1 (Tenda)
$equipmentId = 1;

// Query yang digunakan di controller
$rentedCount = \App\Models\RentItem::where('equipment_id', $equipmentId)
    ->whereHas('rent', function($query) use ($selectedDate) {
        $query->whereDate('start_date', '<=', $selectedDate)
              ->whereDate('end_date', '>=', $selectedDate)
              ->whereIn('status', ['paid', 'rented', 'returned']);
    })
    ->sum('quantity');

echo "Rented Count for Equipment ID $equipmentId: $rentedCount\n";

// Cek raw query
$items = \App\Models\RentItem::where('equipment_id', $equipmentId)->get();
echo "\nAll RentItems for Equipment $equipmentId: " . count($items) . "\n";
foreach ($items as $item) {
    echo "  Item ID: " . $item->id . ", Rent ID: " . $item->rent_id . ", Qty: " . $item->quantity . "\n";
}

// Cek rental record
$rent = \App\Models\Rent::find(1);
if ($rent) {
    echo "\nRent ID 1: Status=" . $rent->status . ", Start=" . $rent->start_date . ", End=" . $rent->end_date . "\n";
}
?>
