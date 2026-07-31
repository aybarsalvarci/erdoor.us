<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Mcamara\LaravelLocalization\Interfaces\LocalizedUrlRoutable;

class ResourcePage extends Model implements LocalizedUrlRoutable
{
    use Translatable;

    protected $fillable = [
        'image_id',
        'icon'
    ];

    protected $translatedAttributes = [
        'title',
        'slug',
        'description',
        'link_text',
        'page_content'
    ];

    public function getLocalizedRouteKey($locale)
    {
        $translation = $this->translate($locale);

        if ($translation && !empty($translation->slug)) {
            return is_array($translation->slug) ? (string) reset($translation->slug) : (string) $translation->slug;
        }

        $fallbackLocale = config('app.fallback_locale');
        $fallbackTranslation = $this->translate($fallbackLocale);

        if ($fallbackTranslation && !empty($fallbackTranslation->slug)) {
            return is_array($fallbackTranslation->slug) ? (string) reset($fallbackTranslation->slug) : (string) $fallbackTranslation->slug;
        }

        return (string) ($this->slug ?? $this->id);
    }

    public function image(): HasOne
    {
        return $this->hasOne(Media::class, 'id', 'image_id');
    }
}
