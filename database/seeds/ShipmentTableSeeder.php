<?php

use App\Shipment;
use Illuminate\Database\Seeder;

class ShipmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Shipment::create([
            'name' => 'JNE'
        ]);
        Shipment::create([
            'name' => 'J&T'
        ]);
        Shipment::create([
            'name' => 'SICEPAT'
        ]);
    }
}
