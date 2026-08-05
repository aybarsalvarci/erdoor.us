<?php

namespace App\Observers;

use App\Jobs\SendNewsletterJob;
use App\Models\Newsletter;
use Illuminate\Support\Facades\Log;

class NewsletterObserver
{
    /**
     * Handle the Newsletter "created" event.
     */
    public function created(Newsletter $newsletter): void
    {
        if(is_null($newsletter->send_at) and $newsletter->status == 'published')
        {
            Log::info("Newsleter created and sending now");

            SendNewsletterJob::dispatch($newsletter);

            $newsletter->status = 'sent';
            $newsletter->save();
        }
    }

    /**
     * Handle the Newsletter "updated" event.
     */
    public function updated(Newsletter $newsletter): void
    {
        //
    }

    /**
     * Handle the Newsletter "deleted" event.
     */
    public function deleted(Newsletter $newsletter): void
    {
        //
    }

    /**
     * Handle the Newsletter "restored" event.
     */
    public function restored(Newsletter $newsletter): void
    {
        //
    }

    /**
     * Handle the Newsletter "force deleted" event.
     */
    public function forceDeleted(Newsletter $newsletter): void
    {
        //
    }
}
