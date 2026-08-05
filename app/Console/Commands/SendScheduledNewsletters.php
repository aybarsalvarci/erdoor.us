<?php

namespace App\Console\Commands;

use App\Jobs\SendNewsletterJob;
use App\Models\Newsletter;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendScheduledNewsletters extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'newsletter:send-scheduled';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Zamanı gelmiş bültenleri kuyruğa aktarır.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $newsletters = Newsletter::where('status', 'published')
            ->whereNotNull('send_at')
            ->where('send_at', '<=', now())
            ->get();

        if ($newsletters->count() > 0) {
            foreach ($newsletters as $newsletter) {
                Log::info("Zamanlanan bülten kuyruğa alınıyor. ID: " . $newsletter->id);

                SendNewsletterJob::dispatch($newsletter);

                $newsletter->status = 'sent';
                $newsletter->save();
            }

            $this->info("{$newsletters->count()} adet bülten kuyruğa eklendi.");
        } else {
            $this->info("Zamanı gelmiş bülten bulunamadı.");
        }
    }
}
