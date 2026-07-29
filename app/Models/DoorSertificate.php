<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DoorSertificate extends Model
{
    protected $fillable = [
        'door_id',
        'image_id'
    ];

    public function image() : HasOne
    {
        return $this->hasOne(Media::class, 'id', 'image_id');
    }
}
