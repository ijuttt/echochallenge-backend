<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\QuestSeeder;
use Database\Seeders\ReportSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\LeaderboardSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            QuestSeeder::class,
            UserSeeder::class,
            ReportSeeder::class,
            LeaderboardSeeder::class, 
        ]);
    }
}
