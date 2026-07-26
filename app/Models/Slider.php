<?php

namespace App\Models;

use App\Observers\SliderObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy(SliderObserver::class)]
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

    public function image(): HasOne
    {
        return $this->hasOne(Media::class, 'id', 'media_id');
    }
}
