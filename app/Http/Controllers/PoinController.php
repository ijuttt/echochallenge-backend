<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserQuestLog;
use Illuminate\Http\Response;

class PoinController extends Controller
{
    public function index()
    {
        $leaderboard = UserQuestLog::with('user:id,fullname,username,photo')
        ->select('user_id')
        ->selectRaw('SUM(point) as points')
        ->groupBy('user_id')
        ->orderByDesc('points')
        ->limit(10)
        ->get()
        ->map(function ($log) {
            return [
                'id'       => $log->user->id,
                'fullname' => $log->user->fullname,
                'username' => $log->user->username,
                'avatar'   => $log->user->photo ?? '',
                'points'   => $log->points,
            ];
        });

        return response()->json([
            "message" => "Success",
            "data"    => $leaderboard
        ], Response::HTTP_OK);
    }
}

