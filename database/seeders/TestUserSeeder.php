<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'username' => 'jpcuser',
                'name' => 'JPC User',
                'email' => 'jpcuser@gmail.com',
                'role' => user::ROLE_JPC,
                'email_verified_at' => now(),
                'password' => bcrypt(12341234),
            ],
        ];

        foreach($userData as $key => $val)
        {
            User::create($val);
        }
    }
}
