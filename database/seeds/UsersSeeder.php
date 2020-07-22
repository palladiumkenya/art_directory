<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::firstOrCreate(array(
            'name' => "Admin",
            'email' => "admin@directory.com",
            'user_group' => 1,
            'password' => bcrypt("pass123"),
        ));
    }
}
