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
        // Door için çeviriye göre sıralama (Paketin kendi metodudur, doğru çalışır)
        $products = Door::where('status', 1)->orderByTranslation('name')->get();

        // ResourcePage için title alanı çeviri tablosunda olduğu için
        // select kullanmak yerine 'with('translations')' ile tüm çevirileri yüklüyoruz.
        $resources = ResourcePage::with('translations')->get();

        view()->share('products', $products);
        view()->share('resources', $resources);
    }
}
