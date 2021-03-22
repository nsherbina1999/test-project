<?php

namespace Database\Seeders;

use App\Models\Shipment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shipments')->insert([
            [
                'name' => 'Free Shipment',
                'price' => 0,
            ],
            [
                'name' => 'Express Shipment',
                'price' => 1000,
            ]
        ]);

        Shipment::factory()->count(3)->create();
    }
}
