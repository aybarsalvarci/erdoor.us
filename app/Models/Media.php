<?php

namespace App\Models;

use App\Observers\MediaObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

#[ObservedBy(MediaObserver::class)]
class Media extends Model
{
    use HasFactory;

    protected $fillable = ['path', 'alt_text', 'type'];

    protected $appends = ['url'];

    public function getUrlAttribute()
    {
        if ($this->type === 'external') {
            return $this->path;
        }

        return Storage::disk('public')->url($this->path);
    }
}
