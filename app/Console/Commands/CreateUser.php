<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates User';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->ask('Enter your name');
        $email = $this->ask('Enter your email');
        $password = $this->secret('Enter your password');

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $token = $user->createToken('api_token');

        $this->info("User created successfully with token: $token->plainTextToken");
    }
}
