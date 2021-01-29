<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use App\ProductCategory;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $ran = rand(1,1000);
    $ran2 = rand(100000,10000000);
    return [
        'name' => 'Produk ke ' . $ran,
        'product_category' => ProductCategory::inRandomOrder()->first()->id,
        'slug' => 'Produk ke ' . $ran,
        'desc' => 'Produk ke ' . $ran,
        'price' => $ran2,
        'qty' => $ran
    ];
});
