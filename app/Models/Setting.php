<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'title',
        'description',
        'keywords',
        'contact_email',
        'sender_email',
        'notification_email',
        'phone',
        'logo',
        'favicon',
        'footer_content',
        'footer_copyright',
        'footer_address',
        'facebook',
        'twitter',
        'instagram',
        'linkedin',
        'youtube'
    ];
}
