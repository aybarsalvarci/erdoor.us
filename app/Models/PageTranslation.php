<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageTranslation extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'content'
    ];

    protected $casts = [
        'content' => 'array',
    ];
}
