<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Report;

class ReportSeeder extends Seeder
{
    public function run(): void
    {
        $reports = [
            ['type' => 'This post is not an eco-activities'],
            ['type' => 'This post contains hate speech'],
            ['type' => 'This post contains misinformation'],
            ['type' => 'This post contains nudity'],
            ['type' => 'This post contains illegal activities'],
        ];

        foreach ($reports as $report) {
            Report::create($report);
        }
    }
}
