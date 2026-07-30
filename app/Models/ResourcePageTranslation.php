<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResourcePageTranslation extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'link_text'
    ];
}
