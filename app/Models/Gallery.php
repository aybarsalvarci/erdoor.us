<?php

namespace App\Models;

use App\Observers\GalleryObserver;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[ObservedBy(GalleryObserver::class)]
class Gallery extends Model
{
    use Translatable;

    protected $fillable = ['image_id'];

    protected $translatedAttributes = ['title'];

    public function media() : HasOne
    {
        return $this->hasOne(Media::class, 'id', 'image_id');
    }
}
