<?php

use App\Product;
use App\ProductGallery;
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
        factory(Product::class, 500)->create();
        // Product::create([
        //     'name' => 'Baju Oblong',
        //     'product_category' => 1,
        //     'slug' => 'baju-oblong',
        //     'desc' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum",
        //     'price' => 150000,
        //     'weight' => 500,
        //     'qty' => 10
        // ]);
        // Product::create([
        //     'name' => 'Baju Kickdenim',
        //     'product_category' => 1,
        //     'slug' => 'baju-kickdenim',
        //     'weight' => 500,
        //     'desc' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum",
        //     'price' => 100000,
        //     'qty' => 10
        // ]);
        // Product::create([
        //     'name' => 'Sepatu Nike',
        //     'product_category' => 4,
        //     'slug' => 'sepatu-nike',
        //     'weight' => 500,
        //     'desc' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum",
        //     'price' => 250000,
        //     'qty' => 5
        // ]);
        // Product::create([
        //     'name' => 'Topi XTM',
        //     'product_category' => 3,
        //     'slug' => 'topi-xtm',
        //     'weight' => 500,
        //     'desc' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum",
        //     'price' => 50000,
        //     'qty' => 100
        // ]);
        // Product::create([
        //     'name' => 'Sepatu Jordan',
        //     'product_category' => 4,
        //     'slug' => 'sepatu-jordan',
        //     'weight' => 500,
        //     'desc' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum",
        //     'price' => 50000,
        //     'qty' => 100
        // ]);
    }
}
