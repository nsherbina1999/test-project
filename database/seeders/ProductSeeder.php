<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'brand_id' => 1,
                'name' => 'Product 1',
                'price' => 5000,
            ],
            [
                'brand_id' => 1,
                'name' => 'Product 2',
                'price' => 1550,
            ],
            [
                'brand_id' => 3,
                'name' => 'Product 3',
                'price' => 1750,
            ],
            [
                'brand_id' => 2,
                'name' => 'Product 4',
                'price' => 10000,
            ],
            [
                'brand_id' => 3,
                'name' => 'Product 5',
                'price' => 1499,
            ]
        ]);
    }
}
