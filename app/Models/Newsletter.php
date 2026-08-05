<?php

namespace App\Models;

use App\Observers\NewsletterObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(NewsletterObserver::class)]
class Newsletter extends Model
{
    protected $fillable = [
        'title',
        'body',
        'button_text',
        'button_link',
        'status',
        'send_at'
    ];
}
