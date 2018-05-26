<?php

use Illuminate\Database\Seeder;

use App\Category;
use App\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Category::all() as $category) {
            $category->products()->saveMany(factory(Product::class, rand(5, 10))->make());
        }
    }
}
