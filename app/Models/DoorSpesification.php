<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class DoorSpesification extends Model
{
    use Translatable;

    protected $fillable = [
        'door_id',
        'order'
    ];

    protected $translatedAttributes = [
        'name',
        'value'
    ];
}
