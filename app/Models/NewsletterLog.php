<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsletterLog extends Model
{
    protected $fillable = [
        'email_subscriber_id',
        'newsletter_id',
        'status',
        'error_message',
        'sent_at',
        'opened_at',
    ];
}
