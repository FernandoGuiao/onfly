<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate(['name' => "user1"],[
            'name' => "user1",
            'email' => "user1@onfly.com",
            'password' => Hash::make("password1"),
        ]);
        
        User::updateOrCreate(['name' => "user2"],[
            'name' => "user2",
            'email' => "user2@onfly.com",
            'password' => Hash::make("password2"),
        ]);
    }
}
