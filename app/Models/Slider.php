<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends Model
{
    /** @use HasFactory<\Database\Factories\SliderFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'media_id',
        'url',
        'order',
        'status'
    ];

    public function image() : HasOne
    {
        return $this->hasOne(Media::class ,'id', 'media_id');
    }
}
