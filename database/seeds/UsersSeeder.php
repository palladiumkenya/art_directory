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
            'name' => "Super Admin",
            'email' => "admin@directory.com",
            'user_group' => 1,
            'county_id' => 30,
            'sub_county_id' => 92,
            'password' => bcrypt("adminpass123"),
        ));

        \App\User::firstOrCreate(array(
            'name' => "Guest User",
            'email' => "guest@art.dir",
            'user_group' => 5,
            'county_id' => 30,
            'sub_county_id' => 92,
            'password' => bcrypt("guest"),
        ));
    }
}
