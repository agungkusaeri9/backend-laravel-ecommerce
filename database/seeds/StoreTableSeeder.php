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
            'email' => 'putristore@gmail.com',
            'phone_number' => '+6281919956872',
            'desc' => 'Adalah toko yang didalamnya  terdapat produk produk pakaian,sepatu,topi dan lainnya',
            'province' => 'Jawa Barat',
            'city' => 'Purwakarta',
            'address' => 'Kp. Citeko Kaler RT 07/03 Ds. Citeko Kaler, Kecamatan Plered, kab. Purwakarta, Jawa Barat',
            'facebook_link' => 'https://www.facebook.com/agunguf21',
            'instagram_link' => 'https://www.instagram.com/agunguf_21',
            'logo' => NULL
        ]);
    }
}
