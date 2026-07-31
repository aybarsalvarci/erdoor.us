<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'category',
        'title',
        'type',
        'description',
        'icon',
        'path',
        'order',
        'status'
    ];
}
