<?php

namespace App\Providers;

use App\Models\Door;
use App\Models\ResourcePage;
use Illuminate\Support\ServiceProvider;

class FooterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $products = Door::where('status', 1)->orderByTranslation('name')->get();

        $resources = ResourcePage::with('translations')->get();

        view()->share('products', $products);
        view()->share('resources', $resources);
    }
}
