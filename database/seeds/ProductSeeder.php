<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'category_id' => 3,
            'name' => 'Havit PBT Pudding Keycaps',
            'image' => 'images/havit keycaps.jpg',
            'description' => 'Havit PBT Double shot keycaps set with puller for DIY Cherry MX',
            'price' => 300000
        ]);
        Product::create([
            'category_id' => 3,
            'name' => 'Sakura Keycaps Tenkeyless',
            'image' => 'images/sakura-keycaps.png',
            'description' => 'Tenkeyless keycaps with sakura pattern limited edition',
            'price' => 500000
        ]);
        Product::create([
            'category_id' => 1,
            'name' => 'Logitech G512',
            'image' => 'images/logitech-g512.jfif',
            'description' => 'Logitech Blue Clicky Romer-G keyboard with RGB Lighting',
            'price' => 1500000
        ]);
        Product::create([
            'category_id' => 2,
            'name' => 'Cherry MX Blue Switch',
            'image' => 'images/cherry-mx-blue.jpg',
            'description' => 'Original Cherry MX Blue Switch (Tactile feeling)',
            'price' => 10000
        ]);
        Product::create([
            'category_id' => 2,
            'name' => 'Kailh Brown Switch',
            'image' => 'images/kailh-brown.jpg',
            'description' => 'Kailh brown switch',
            'price' => 7000
        ]);
        Product::create([
            'category_id' => 4,
            'name' => 'PCB Bluetooth Mechanical',
            'image' => 'images/pcb.jfif',
            'description' => 'PCB Bluetooth Mechanical Keyboard BLE 60%',
            'price' => 600000
        ]);
    }
}
