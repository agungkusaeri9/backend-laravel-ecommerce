<?php

use App\City;
use App\Province;
use Illuminate\Database\Seeder;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $daftarProvinsi = RajaOngkir::provinsi()->all();
        foreach($daftarProvinsi as $province){
            Province::create([
                'province_id' => $province['province_id'],
                'province_name' => $province['province']
            ]);
            $daftarKota = RajaOngkir::kota()->dariProvinsi($province['province_id'])->get();
            foreach($daftarKota as $city){
                City::create([
                    'province_id' => $province['province_id'],
                    'city_id' => $city['city_id'],
                    'city_name' => $city['city_name']
                ]);
            }
        }
    }
}
