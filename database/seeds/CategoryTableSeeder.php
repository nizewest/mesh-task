<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();
        factory(App\Category::class, rand(1, 10))->create()->each(function ($c1) {
            factory(App\Category::class, rand(1, 10))->make()->each(function ($c2) use ($c1) {
                $c1->appendNode($c2);
                factory(App\Category::class, rand(1, 10))->make()->each(function ($c3) use ($c2) {
                    $c2->appendNode($c3);
                });
            });
        });
    }
}
