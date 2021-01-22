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
            'name' => 'Baju',
            'slug' => 'baju'
        ]);
        ProductCategory::create([
            'name' => 'Celana',
            'slug' => 'celana'
        ]);
        ProductCategory::create([
            'name' => 'Topi',
            'slug' => 'topi'
        ]);
        ProductCategory::create([
            'name' => 'Sepatu',
            'slug' => 'sepatu'
        ]);
        ProductCategory::create([
            'name' => 'Sandal',
            'slug' => 'sandal'
        ]);
    }
}
