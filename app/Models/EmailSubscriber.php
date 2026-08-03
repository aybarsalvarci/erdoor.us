<?php

namespace App\Models;

use App\Observers\EmailSubscriberObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(EmailSubscriberObserver::class)]
class EmailSubscriber extends Model
{
    protected $fillable = [
        'email',
        'status',
        'verification_token',
        'verified_at',
    ];
}
