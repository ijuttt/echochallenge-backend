<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Report;

class ReportSeeder extends Seeder
{
    public function run(): void
    {
        $reports = [
            ['type' => 'Spam'],
            ['type' => 'Abusive Content'],
            ['type' => 'Misinformation'],
            ['type' => 'Hate Speech'],
            ['type' => 'Nudity'],
        ];

        foreach ($reports as $report) {
            Report::create($report);
        }
    }
}
