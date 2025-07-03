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
                'fullname' => 'Raditya Banu',
                'email' => 'radityabanu1312@gmail.com',
                'username' => 'raditya1312',
                'password' => bcrypt('banu1312'),
                'role' => 'SuperAdmin'
            ]
        ];

         // 20 user biasa
         $indonesianUsers = [
            ['Dimas Pratama', 'dimas01'],
            ['Rizky Maulana', 'rizky02'],
            ['Putri Aulia', 'putri03'],
            ['Andi Wijaya', 'andi04'],
            ['Siti Rahma', 'siti05'],
            ['Budi Santoso', 'budi06'],
            ['Rina Ayu', 'rina07'],
            ['Agus Saputra', 'agus08'],
            ['Fajar Nugroho', 'fajar09'],
            ['Lestari Dewi', 'lestari10'],
            ['Eka Ramadhan', 'eka11'],
            ['Ayu Kartika', 'ayu12'],
            ['Rizal Hakim', 'rizal13'],
            ['Desi Marlina', 'desi14'],
            ['Joko Susilo', 'joko15'],
            ['Fitri Handayani', 'fitri16'],
            ['Teguh Hidayat', 'teguh17'],
            ['Nadia Utami', 'nadia18'],
            ['Irwan Kurniawan', 'irwan19'],
            ['Yuni Astuti', 'yuni20'],
        ];

        foreach ($indonesianUsers as $index => $user) {
            $users[] = [
                'fullname' => $user[0],
                'email' => $user[1] . '@mail.com',
                'username' => $user[1],
                'password' => bcrypt('password123'),
                'role' => 'user'
            ];
        }
        
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
