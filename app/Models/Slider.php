<?php

namespace App\Models;

use App\Observers\SliderObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[ObservedBy(SliderObserver::class)]
class Slider extends Model
{
    /** @use HasFactory<\Database\Factories\SliderFactory> */
    use HasFactory;

    protected $fillable = [
        'media_id',
        'url',
        'order',
        'status'
    ];

    public function image(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'media_id', 'id');
    }
}
