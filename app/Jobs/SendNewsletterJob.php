<?php

namespace App\Jobs;

use App\Mail\NewsletterMail;
use App\Models\EmailSubscriber;
use App\Models\Newsletter;
use App\Models\NewsletterLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendNewsletterJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Newsletter $newsletter)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info("Newsletter job started");
        $subscribers = EmailSubscriber::where('status', 1)
            ->whereNotNull('verified_at')
            ->whereNull('delete_code')
            ->chunkById(100, function ($subscribers) {
                Log::info("Mail gönderilme kuyruğundaki abone sayısı: " . $subscribers->count());
                foreach ($subscribers as $subscriber) {
                    $log = NewsletterLog::create([
                        'newsletter_id' => $this->newsletter->id,
                        'email_subscriber_id' => $subscriber->id,
                        'status' => 'pending'
                    ]);

                    try {
                       Mail::to($subscriber->email)->send(new NewsletterMail($subscriber, $this->newsletter));

                       $log->update([
                           'status' => 'sent',
                           'sent_at' => now()
                       ]);

                    }
                    catch (\Exception $e) {
                        Log::error("An error occured while sending newsletter: " . $e->getMessage(), [
                            'exception' => $e,
                            'subscriber' => $subscriber,
                            'log' => $log
                        ]);

                        $log->update([
                            'status' => 'failed',
                            'error_message' => $e->getMessage()
                        ]);
                    }
               }
            });
    }
}
