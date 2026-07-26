<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DoorVariant extends Model
{
    protected $fillable = [
        'door_id',
        'mini_picture_id',
        'picture_id',
        'name'
    ];

    public function miniPicture() : BelongsTo
    {
        return $this->belongsTo(Media::class, 'mini_picture_id');
    }

    public function picture() : BelongsTo
    {
        return $this->belongsTo(Media::class, 'picture_id');
    }
}
