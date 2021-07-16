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
            'name' => 'Hijab',
            'slug' => 'hijab'
        ]);
    }
}
