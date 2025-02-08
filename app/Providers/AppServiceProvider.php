<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Item;
use App\Observers\ItemObserver;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }
    
    public function boot(): void
    {
        Item::observe(ItemObserver::class);
    }
}
