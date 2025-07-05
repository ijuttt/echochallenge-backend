<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Response;

class PoinController extends Controller
{
    public function index()
    {
        $leaderboard = User::select('id', 'fullname', 'username', 'photo', 'points')
            ->orderByDesc('points')
            ->limit(10)
            ->get()
            ->map(function ($user) {
                return [
                    'id'       => $user->id,
                    'fullname' => $user->fullname,
                    'username' => $user->username,
                    'photo'    => $user->photo ?? '',
                    'points'   => $user->points ?? 0,
                ];
            });

        return response()->json([
            "message" => "Success",
            "data"    => $leaderboard
        ], Response::HTTP_OK);
    }
}

