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
    ];

    public function getLocalizedRouteKey($locale)
    {
        $translation = $this->translate($locale);

        return $translation ? $translation->slug : $this->translate(config('app.fallback_locale'))->slug;
    }

    public function image(): HasOne
    {
        return $this->hasOne(Media::class, 'id', 'image_id');
    }
}
