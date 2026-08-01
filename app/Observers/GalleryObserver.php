<?php

namespace App\Observers;

use App\Models\Gallery;

class GalleryObserver
{
    /**
     * Handle the Gallery "created" event.
     */
    public function created(Gallery $gallery): void
    {
        //
    }

    /**
     * Handle the Gallery "updated" event.
     */
    public function updated(Gallery $gallery): void
    {
        //
    }

    /**
     * Handle the Gallery "deleted" event.
     */
    public function deleted(Gallery $gallery): void
    {
        $gallery->media()->delete();
    }

    /**
     * Handle the Gallery "restored" event.
     */
    public function restored(Gallery $gallery): void
    {
        //
    }

    /**
     * Handle the Gallery "force deleted" event.
     */
    public function forceDeleted(Gallery $gallery): void
    {
        //
    }
}
