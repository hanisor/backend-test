<?php

use Illuminate\Foundation\Console\ClosureCommand;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Console\Scheduling\Schedule;

// Command to display an inspiring quote
Artisan::command('inspire', function () {
    /** @var ClosureCommand $this */
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Register the delete inactive users command
app()->booted(function () {
    $schedule = app(Schedule::class);
    $schedule->command('users:delete-inactive')->daily();
});

