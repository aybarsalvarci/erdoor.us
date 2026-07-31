<?php

namespace App\Models;

use App\Observers\PageObserver;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(PageObserver::class)]
class Page extends Model
{
    use Translatable;

    protected $translatedAttributes = [
        'title',
        'slug',
        'description',
        'content'
    ];

    protected $casts = [
        'content' => 'array'
    ];
}
