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
            'name' => 'Sakura Keycaps Tenkeyless',
            'image' => 'images/sakura-keycaps.png',
            'description' => 'Tenkeyless keycaps with sakura pattern limited edition',
            'price' => 800000
        ]);
        Product::create([
            'category_id' => 3,
            'name' => 'Sakura Keycaps Full asdfasdf as dfas d Tenkeyless',
            'image' => 'images/sakura-keycaps.png',
            'description' => 'Tenkeyless keycaps with sakura pattern limited edition',
            'price' => 800000
        ]);
        Product::create([
            'category_id' => 3,
            'name' => 'Sakura Keycaps Tenkeyless asdf asd fasdf as ',
            'image' => 'images/sakura-keycaps.png',
            'description' => 'Tenkeyless keycaps with sakura pattern limited edition',
            'price' => 800000
        ]);
        Product::create([
            'category_id' => 3,
            'name' => 'Sakura',
            'image' => 'images/sakura-keycaps.png',
            'description' => 'Tenkeyless keycaps with sakura pattern limited edition',
            'price' => 800000
        ]);
    }
}
