<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('newsletter:send-scheduled')->everyMinute();

Schedule::command('queue:work --stop-when-empty')
    ->everyMinute()
    ->withoutOverlapping();
