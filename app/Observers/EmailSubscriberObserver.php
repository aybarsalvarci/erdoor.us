<?php

namespace App\Observers;

use App\Mail\VerifyNewsletterSubscriptionEmail;
use App\Models\EmailSubscriber;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class EmailSubscriberObserver
{
    public function created(EmailSubscriber $emailSubscriber): void
    {
        try {
            $emailSubscriber->verification_token = Str::uuid();;
            $emailSubscriber->save();
            $verificationUrl = route('newsletter.verify', $emailSubscriber->verification_token);

            Mail::to($emailSubscriber->email)->send(new VerifyNewsletterSubscriptionEmail($emailSubscriber, $verificationUrl));
        } catch (\Exception $exception) {
            Log::error("An error occured while sending VerifyNewsletterSubscriptionEmail: " . $exception->getMessage(), ['exception' => $exception]);
        }
    }

    /**
     * Handle the EmailSubscriber "updated" event.
     */
    public function updated(EmailSubscriber $emailSubscriber): void
    {
        //
    }

    /**
     * Handle the EmailSubscriber "deleted" event.
     */
    public function deleted(EmailSubscriber $emailSubscriber): void
    {
        //
    }

    /**
     * Handle the EmailSubscriber "restored" event.
     */
    public function restored(EmailSubscriber $emailSubscriber): void
    {
        //
    }

    /**
     * Handle the EmailSubscriber "force deleted" event.
     */
    public function forceDeleted(EmailSubscriber $emailSubscriber): void
    {
        //
    }
}
