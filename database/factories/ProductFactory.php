<?php

use Faker\Generator as Faker;
use App\Product;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => rtrim($faker->sentence(2), '.'),
        'description' => $faker->paragraph,
        'image' => 'https://picsum.photos/200?random',
    ];
});
