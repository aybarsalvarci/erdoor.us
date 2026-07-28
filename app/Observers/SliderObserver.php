<?php

namespace App\Observers;

use App\Models\Slider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SliderObserver
{
    /**
     * Handle the Slider "created" event.
     */
    public function created(Slider $slider): void
    {
        $locales = array_keys(config('laravellocalization.supportedLocales'));
        foreach ($locales as $locale) {
            Cache::forget("homepage_sliders_data_{$locale}");
        }
    }

    /**
     * Handle the Slider "updated" event.
     */
    public function updated(Slider $slider): void
    {
        $locales = array_keys(config('laravellocalization.supportedLocales'));
        foreach ($locales as $locale) {
            Cache::forget("homepage_sliders_data_{$locale}");
        }
    }

    /**
     * Handle the Slider "deleted" event.
     */
    public function deleted(Slider $slider): void
    {
        $locales = array_keys(config('laravellocalization.supportedLocales'));
        foreach ($locales as $locale) {
            Cache::forget("homepage_sliders_data_{$locale}");
        }
    }

    /**
     * Handle the Slider "restored" event.
     */
    public function restored(Slider $slider): void
    {
        $locales = array_keys(config('laravellocalization.supportedLocales'));
        foreach ($locales as $locale) {
            Cache::forget("homepage_sliders_data_{$locale}");
        }
    }

    /**
     * Handle the Slider "force deleted" event.
     */
    public function forceDeleted(Slider $slider): void
    {
        $locales = array_keys(config('laravellocalization.supportedLocales'));
        foreach ($locales as $locale) {
            Cache::forget("homepage_sliders_data_{$locale}");
        }
    }
}
