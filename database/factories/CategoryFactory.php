<?php

use Faker\Generator as Faker;
use App\Category;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => rtrim($faker->sentence(2), '.'),
    ];
});
