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
        Log::debug("Created event tetiklenid.");
        Cache::forget('homepage_sliders_data');
    }

    /**
     * Handle the Slider "updated" event.
     */
    public function updated(Slider $slider): void
    {
        Log::debug("Updated event tetiklenid.");
        Cache::forget('homepage_sliders_data');

    }

    /**
     * Handle the Slider "deleted" event.
     */
    public function deleted(Slider $slider): void
    {
        Log::debug("Deleted event tetiklenid.");
        Cache::forget('homepage_sliders_data');

    }

    /**
     * Handle the Slider "restored" event.
     */
    public function restored(Slider $slider): void
    {
    }

    /**
     * Handle the Slider "force deleted" event.
     */
    public function forceDeleted(Slider $slider): void
    {
        //
    }
}
