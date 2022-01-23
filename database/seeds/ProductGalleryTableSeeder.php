<?php

use App\ProductGallery;
use Illuminate\Database\Seeder;

class ProductGalleryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ProductGallery::class, 1000)->create();
    }
}
