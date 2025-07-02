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
<<<<<<< HEAD
                'role'=>'SuperAdmin'
=======
                'role' => 'SuperAdmin'
>>>>>>> f25ba76fbfeea7c5aa4015e66ef025f688df2f33
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
