<?php

namespace App\Observers;

use App\Models\Page;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
class PageObserver
{
    /**
     * Handle the Page "saved" event.
     */
    public function saved(Page $page): void
    {
        // homepage
        if($page->id == 1)
        {
            $locales = array_keys(config('laravellocalization.supportedLocales'));
            foreach ($locales as $locale) {
                Cache::forget("homepage_data_{$locale}");
            }
        }
    }

}
