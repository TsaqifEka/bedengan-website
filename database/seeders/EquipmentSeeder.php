<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Equipment;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run()
{
    $items = [
        [
            'name' => '2-Person Tent',
            'price' => 75000,
            'image' => 'img/tent-2.jpg', // Sesuaikan path gambarmu
            'description' => 'Compact waterproof dome tent, easy to set up for couples.',
            'quantity' => 10
        ],
        [
            'name' => '4-Person Tent',
            'price' => 125000,
            'image' => 'img/tent-4.jpg',
            'description' => 'Spacious family tent with vestibule for extra luggage storage.',
            'quantity' => 10
        ],
        [
            'name' => 'Sleeping Bag',
            'price' => 35000,
            'image' => 'img/sb.jpg',
            'description' => 'Warm and cozy sleeping bag suitable for cold mountain nights.',
            'quantity' => 10
        ],
        [
            'name' => 'Portable Stove',
            'price' => 50000,
            'image' => 'img/stove.jpg',
            'description' => 'Windproof portable gas stove (gas canister not included).',
            'quantity' => 10
        ],
        [
            'name' => 'Cooking Set',
            'price' => 40000,
            'image' => 'img/cookset.jpg',
            'description' => 'Complete set of pots, pans, and utensils for outdoor cooking.',
            'quantity' => 10
        ],
        [
            'name' => 'LED Lantern',
            'price' => 25000,
            'image' => 'img/lantern.jpg',
            'description' => 'Bright battery-powered LED lantern for campsite lighting.',
            'quantity' => 10
        ],
    ];

    foreach ($items as $item) {
        Equipment::create($item);
    }
}
}
