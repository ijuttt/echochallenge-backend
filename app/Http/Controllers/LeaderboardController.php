<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeaderboardController extends Controller
{
    public function index()
    {
        $leaderboard = DB::table('user_points')
            ->join('users', 'user_points.user_id', '=', 'users.id')
            ->select('user_points.user_id', 'users.fullname', DB::raw('SUM(user_points.points) as total_points'))
            ->groupBy('user_points.user_id', 'users.fullname')
            ->orderByDesc('total_points')
            ->limit(10)
            ->get();

        return response()->json($leaderboard);
    }
}
