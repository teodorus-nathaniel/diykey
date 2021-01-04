<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Keyboards',
        ]);
        Category::create([
            'name' => 'Switches',
        ]);
        Category::create([
            'name' => 'Keycaps',
        ]);
        Category::create([
            'name' => 'Boards',
        ]);
    }
}
