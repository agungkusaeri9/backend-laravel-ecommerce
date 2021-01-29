<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ProductGallery;
use Faker\Generator as Faker;


$autoIncrement = autoIncrement();

$factory->define(ProductGallery::class, function (Faker $faker) use ($autoIncrement) {
    $autoIncrement->next();
    $random = rand(1,100);
    return [
        'product_id' => $autoIncrement->current(),
        'photo' => "https://picsum.photos/id/{$random}/200/300",
        'is_default' => 1
    ];
});

function autoIncrement()
{
    for ($i = 0; $i <= 1000; $i++) {
        yield $i;
    }
}