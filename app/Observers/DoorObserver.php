<?php

namespace App\Observers;

use App\Models\Door;
use Illuminate\Support\Facades\Cache;

class DoorObserver
{
    /**
     * Handle the Door "created" event.
     */
    public function created(Door $door): void
    {
        Cache::forget('homepage_doors_data');
    }

    /**
     * Handle the Door "updated" event.
     */
    public function updated(Door $door): void
    {
        Cache::forget('homepage_doors_data');

    }

    /**
     * Handle the Door "deleted" event.
     */
    public function deleted(Door $door): void
    {
        Cache::forget('homepage_doors_data');

    }

    /**
     * Handle the Door "restored" event.
     */
    public function restored(Door $door): void
    {
        Cache::forget('homepage_doors_data');

    }

    /**
     * Handle the Door "force deleted" event.
     */
    public function forceDeleted(Door $door): void
    {
        Cache::forget('homepage_doors_data');

    }
}
