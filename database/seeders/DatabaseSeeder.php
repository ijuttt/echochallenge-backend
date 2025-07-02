<?php
use Illuminate\Database\Seeder;
use Database\Seeders\QuestSeeder;
use Database\Seeders\userSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            QuestSeeder::class,
            userSeeder::class,
        ]);
    }
}

