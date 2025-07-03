<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;   // ← tambahkan

class LeaderboardController extends Controller
{
    public function index()
    {
        $leaderboard = DB::table('user_points')
            ->join('users', 'user_points.user_id', '=', 'users.id')
            ->select(
                'users.id',
                'users.fullname',
                'users.username',
                DB::raw('COALESCE(users.photo, "") as avatar'),
                DB::raw('SUM(user_points.points) as points')
            )
            ->groupBy('users.id', 'users.fullname', 'users.username', 'users.photo')
            ->orderByDesc('points')
            ->limit(10)
            ->get();

        return response()->json([
            "message" => "Success",
            "data"    => $leaderboard
        ], Response::HTTP_OK);
    }
}
