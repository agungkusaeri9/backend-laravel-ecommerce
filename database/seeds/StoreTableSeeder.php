<?php

use App\Store;
use Illuminate\Database\Seeder;

class StoreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Store::create([
            'name' => 'My Store',
            'desc' => 'Adalah toko yang didalamnya  terdapat produk produk pakaian,sepatu,topi dan lainnya',
            'address' => 'Kp. Citeko Kaler RT 07/03 Ds. Citeko Kaler, Kecamatan Plered, kab. Purwakarta, Jawa Barat',
            'photo' => NULL
        ]);
    }
}
