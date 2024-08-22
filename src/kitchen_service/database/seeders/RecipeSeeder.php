<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('recipes')->insert([
            [
                'name' => 'Chicken Rice Delight',
                'ingredients' => json_encode([
                    'chicken' => 1,
                    'rice' => 1,
                    'onion' => 1,
                    'tomato' => 1
                ]),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Beef and Potato Stew',
                'ingredients' => json_encode([
                    'meat' => 1,
                    'potato' => 2,
                    'onion' => 1,
                    'tomato' => 1
                ]),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Vegetable Salad',
                'ingredients' => json_encode([
                    'lettuce' => 2,
                    'tomato' => 2,
                    'onion' => 1,
                    'lemon' => 1
                ]),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Cheesy Chicken Bake',
                'ingredients' => json_encode([
                    'chicken' => 1,
                    'cheese' => 1,
                    'potato' => 2,
                    'ketchup' => 1
                ]),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Tomato Rice',
                'ingredients' => json_encode([
                    'rice' => 1,
                    'tomato' => 3,
                    'onion' => 1,
                    'ketchup' => 1
                ]),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Chicken Lettuce Wraps',
                'ingredients' => json_encode([
                    'chicken' => 1,
                    'lettuce' => 4,
                    'onion' => 1,
                    'cheese' => 1
                ]),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
