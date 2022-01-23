<?php

use App\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductCategory::create([
            'name' => 'Elektronik',
            'slug' => 'elektronik',
            'icon' => 'elektroin.png'
        ]);
        ProductCategory::create([
            'name' => 'Handphone & Aksesoris',
            'slug' => 'handphone-aksesoris',
            'icon' => 'handphone-aksesoris.png'
        ]);
        ProductCategory::create([
            'name' => 'Pakaian Pria',
            'slug' => 'pakaian-pria',
            'icon' => 'pakaian-pria.png'
        ]);
        ProductCategory::create([
            'name' => 'Sepatu Pria',
            'slug' => 'sepatu-pria',
            'icon' => 'sepatu-pria.png'
        ]);
        ProductCategory::create([
            'name' => 'Tas Pria',
            'slug' => 'tas-pria',
            'icon' => 'tas-pria.png'
        ]);
        ProductCategory::create([
            'name' => 'Jam Tangan',
            'slug' => 'jam-tangan',
            'icon' => 'jam-tangan.png'
        ]);
        ProductCategory::create([
            'name' => 'Kesehatan',
            'slug' => 'kesehatan',
            'icon' => 'kesehatan.png'
        ]);
        ProductCategory::create([
            'name' => 'Makanan & Minuman',
            'slug' => 'makanan-minuman',
            'icon' => 'makanan-minuman.png'
        ]);
        ProductCategory::create([
            'name' => 'Pakaian Wanita',
            'slug' => 'pakaian-wanita',
            'icon' => 'pakaian-wanita.png'
        ]);
        ProductCategory::create([
            'name' => 'Sepatu Wanita',
            'slug' => 'sepatu-wanita',
            'icon' => 'sepatu-wanita.png'
        ]);
    }
}
