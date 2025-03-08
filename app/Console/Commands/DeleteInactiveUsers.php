<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;

class DeleteInactiveUsers extends Command
{
    protected $signature = 'app:delete-inactive-users';
    protected $description = 'Command description';

     public function handle()
    {
        $oneMonthAgo = Carbon::now()->subMonth();
        User::where('last_login_at', '<', $oneMonthAgo)->delete();
        $this->info('Inactive users deleted successfully.');
    }
}
