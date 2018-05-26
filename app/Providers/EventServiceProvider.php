<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Category;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Category::deleting(function ($category) {
            foreach ($category->descendants as $descendant) {
                foreach ($descendant->products as $product) {
                    $product->delete();
                };
            }
            foreach ($category->products as $product) {
                $product->delete();
            }
        });
    }
}
