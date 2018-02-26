<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        factory(User::class)->create([
            'username' => 'jaggy',
            'email'    => 'jaggy@artisan.studio',
            'password' => bcrypt('password'),
        ]);
    }
}
