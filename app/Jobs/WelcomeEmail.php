<?php

namespace App\Jobs;

use App\Mail\WelcomeEmail as MailWelcomeEmail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class WelcomeEmail implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public User $user)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Send welcome email to user
        Mail::to($this->user->email)->send(new MailWelcomeEmail($this->user));
    }
}
