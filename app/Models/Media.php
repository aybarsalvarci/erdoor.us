<?php

namespace App\Models;

use App\Observers\MediaObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Casts\Attribute;

#[ObservedBy(MediaObserver::class)]
class Media extends Model
{
    /** @use HasFactory<\Database\Factories\MediaFactory> */
    use HasFactory;

    protected $fillable = ['path', 'alt_text', 'type'];

    protected function url(): Attribute
    {
        return Attribute::make(
          get: function ($value, $attributes) {
              if($attributes['type'] == 'external') {
                  return $attributes['path'];
              }

              return Storage::disk('public')->url($attributes['path']);
            }
        );
    }
}
