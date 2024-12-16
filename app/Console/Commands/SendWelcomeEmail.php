<?php

namespace App\Console\Commands;

use App\Jobs\WelcomeEmail;
use App\Models\User;
use Illuminate\Console\Command;

class SendWelcomeEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-welcome-email {user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Send welcome email to user
        $user = User::find($this->argument('user'));
        WelcomeEmail::dispatch($user);
    }
}
