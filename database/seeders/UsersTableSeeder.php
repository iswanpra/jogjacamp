<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
                'name'  => str_random(20),
                'email' => str_random(10) . '@gmail.com',
                'password'  => bcrypt('secret')
        ]);
    }
}
