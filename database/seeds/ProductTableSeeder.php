<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'Baju Oblong',
            'product_category' => 1,
            'slug' => 'baju-oblong',
            'desc' => 'Baju Obong terbaru',
            'price' => 150000,
            'qty' => 10
        ]);
        Product::create([
            'name' => 'Baju Kickdenim',
            'product_category' => 1,
            'slug' => 'baju-kickdenim',
            'desc' => 'Baju kickdenim terbaru',
            'price' => 100000,
            'qty' => 10
        ]);
        Product::create([
            'name' => 'Sepatu Nike',
            'product_category' => 4,
            'slug' => 'sepatu-nike',
            'desc' => 'Sepatu nike terbaru',
            'price' => 250000,
            'qty' => 5
        ]);
        Product::create([
            'name' => 'Topi XTM',
            'product_category' => 3,
            'slug' => 'topi-xtm',
            'desc' => 'topi xtm terbaru',
            'price' => 50000,
            'qty' => 100
        ]);
    }
}
