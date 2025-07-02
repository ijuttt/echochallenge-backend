<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'fullname'=>'Raditya Banu',
                'email'=>'radityabanu1312@gmail.com',
                'username'=>'raditya1312',
                'password'=> bcrypt('banu1312'),
                'role'=>'SuperAdmin'
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
