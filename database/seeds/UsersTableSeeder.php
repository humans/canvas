<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        factory(User::class)->states('inactive')->create([
            'name'     => 'Jake Peralta',
            'username' => 'jake',
            'email'    => 'jake@nine-nine.nyc',
            'password' => bcrypt('password'),
        ]);

        User::create()->states('admin')->create([
            'name'     => 'Jaggy Gauran',
            'username' => 'jaggy',
            'email'    => 'jaggy@artisan.studio',
            'password' => bcrypt('password'),
        ]);

    }
}
