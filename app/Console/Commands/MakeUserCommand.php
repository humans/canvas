<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class MakeUserCommand extends Command
{
    protected $signature = 'make:user';

    protected $description = 'Create a new active user.';

    public function handle()
    {
        User::create([
            'name'     => $this->ask("What is your name?"),
            'email'    => $this->ask("What is your email address?"),
            'username' => $this->ask("What is your username?"),
            'password' => bcrypt($this->secret("What is your password?")),
            'is_admin' => $this->confirm('Super user?', 'y'),
        ]);

        $this->info('Successfully created user!');
    }
}
