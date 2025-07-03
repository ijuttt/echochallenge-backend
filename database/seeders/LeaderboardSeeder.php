<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class LeaderboardSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['fullname' => 'Andi Saputra', 'email' => 'andi@example.com', 'username' => 'andi'],
            ['fullname' => 'Budi Santoso', 'email' => 'budi@example.com', 'username' => 'budi'],
            ['fullname' => 'Citra Dewi', 'email' => 'citra@example.com', 'username' => 'citra'],
            ['fullname' => 'Dedi Prasetyo', 'email' => 'dedi@example.com', 'username' => 'dedi'],
            ['fullname' => 'Eka Lestari', 'email' => 'eka@example.com', 'username' => 'eka'],
            ['fullname' => 'Fajar Nugroho', 'email' => 'fajar@example.com', 'username' => 'fajar'],
            ['fullname' => 'Gita Ramadhani', 'email' => 'gita@example.com', 'username' => 'gita'],
            ['fullname' => 'Hendra Wijaya', 'email' => 'hendra@example.com', 'username' => 'hendra'],
            ['fullname' => 'Intan Permata', 'email' => 'intan@example.com', 'username' => 'intan'],
            ['fullname' => 'Joko Sutrisno', 'email' => 'joko@example.com', 'username' => 'joko'],
        ];

        foreach ($users as $userData) {
            $userId = DB::table('users')->insertGetId(array_merge($userData, [
                'password' => Hash::make('password'),
                'role' => 'User',
                'created_at' => now(),
                'updated_at' => now(),
            ]));

            for ($i = 0; $i < rand(3, 5); $i++) {
                DB::table('user_points')->insert([
                    'user_id' => $userId,
                    'points' => rand(10, 100),
                    'created_at' => Carbon::now()->subDays(rand(0, 10)),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
