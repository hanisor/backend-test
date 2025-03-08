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

// Ensure the scheduler is properly registered
app()->booted(function () {
    $schedule = app(Schedule::class);
    
    // Register the delete inactive users command to run daily
    $schedule->command('users:delete-inactive')->daily();
});
