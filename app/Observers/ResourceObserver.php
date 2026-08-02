<?php

namespace App\Observers;

use App\Models\ResourcePage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ResourceObserver
{

    /**
     * Handle the ResourcePage "updated" event.
     */
    public function saved(ResourcePage $resourcePage): void
    {
        $locales = array_keys(config('laravellocalization.supportedLocales'));
        foreach ($locales as $locale) {
            Cache::forget("resources_pages_{$locale}");
        }
    }


}
