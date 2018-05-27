<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (config('database.default') == 'pgsql') {
            DB::statement('TRUNCATE products CASCADE');
            DB::statement('TRUNCATE categories CASCADE');
        } else {
            DB::table('products')->truncate();
            DB::table('categories')->truncate();
        }
        factory(App\Category::class, rand(2, 3))->create()->each(function ($c1) {
            factory(App\Category::class, rand(1, 3))->make()->each(function ($c2) use ($c1) {
                $c1->appendNode($c2);
                factory(App\Category::class, rand(1, 3))->make()->each(function ($c3) use ($c2) {
                    $c2->appendNode($c3);
                });
            });
        });
    }
}
