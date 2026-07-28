<?php

namespace App\Observers;

use App\Models\Door;
use Illuminate\Support\Facades\Cache;
use Mcamara\LaravelLocalization\LaravelLocalization;

class DoorObserver
{
    /**
     * Handle the Door "created" event.
     */
    public function created(Door $door): void
    {
        $locales = array_keys(config('laravellocalization.supportedLocales'));
        foreach ($locales as $locale) {
            Cache::forget("homepage_doors_data_{$locale}");
        }
    }

    /**
     * Handle the Door "updated" event.
     */
    public function updated(Door $door): void
    {
        $locales = array_keys(config('laravellocalization.supportedLocales'));
        foreach ($locales as $locale) {
            Cache::forget("homepage_doors_data_{$locale}");
        }
    }

    /**
     * Handle the Door "deleted" event.
     */
    public function deleted(Door $door): void
    {
        $locales = array_keys(config('laravellocalization.supportedLocales'));
        foreach ($locales as $locale) {
            Cache::forget("homepage_doors_data_{$locale}");
        }
    }

    /**
     * Handle the Door "restored" event.
     */
    public function restored(Door $door): void
    {
        $locales = array_keys(config('laravellocalization.supportedLocales'));
        foreach ($locales as $locale) {
            Cache::forget("homepage_doors_data_{$locale}");
        }
    }

    /**
     * Handle the Door "force deleted" event.
     */
    public function forceDeleted(Door $door): void
    {
        $locales = array_keys(config('laravellocalization.supportedLocales'));
        foreach ($locales as $locale) {
            Cache::forget("homepage_doors_data_{$locale}");
        }
    }
}
