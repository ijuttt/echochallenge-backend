<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Quest;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LeaderboardSeeder extends Seeder
{
    public function run(): void
    {
        $totalUsers = User::count();
        $totalQuests = Quest::count();

        if ($totalUsers < 10 || $totalQuests < 1) {
            throw new \Exception("Minimal 10 user dan minimal 1 quest diperlukan di database.");
        }

        // Ambil max 100 user acak
        $randomUserIds = User::inRandomOrder()->limit(min(100, $totalUsers))->pluck('id')->toArray();
        $selectedUsers = User::whereIn('id', $randomUserIds)->get();

        // Ambil semua quest untuk dipilih random
        $quests = Quest::all();

        $logs = [];

        foreach ($selectedUsers as $user) {
            // Setiap user menyelesaikan 3–5 quest acak
            $questsSample = $quests->random(rand(3, min(5, $quests->count())));

            foreach ($questsSample as $quest) {
                $logs[] = [
                    'user_id' => $user->id,
                    'quest_name' => $quest->quest,
                    'point' => $quest->point,
                    'created_at' => Carbon::now()->subDays(rand(0, 10)),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('user_quest_logs')->insert($logs);
    }
}
