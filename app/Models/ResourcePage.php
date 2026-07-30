<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ResourcePage extends Model
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

    public function image() : HasOne
    {
        return $this->hasOne(Media::class, 'id', 'image_id');
    }
}
