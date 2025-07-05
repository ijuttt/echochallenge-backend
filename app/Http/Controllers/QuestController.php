<?php

namespace App\Http\Controllers;

use App\Models\Quest;
use App\Models\UserQuestLog;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class QuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $randomIds = collect(range(1, 48))->shuffle()->take(3);
        $quests = Quest::whereIn('id', $randomIds)->get();

        return response()->json($quests);
    }

    public function completedQuest(Request $request, Quest $quest)
    {
        try {
            // FIXED typo: 'sacntum' → 'sanctum'
            $user = auth('sanctum')->user();

            // Prevent duplicate quest completion (optional but recommended)
            $alreadyCompleted = UserQuestLog::where('user_id', $user->id)
                ->where('quest_name', $quest->quest)
                ->exists();

            if ($alreadyCompleted) {
                return response()->json([
                    'message' => 'Quest already completed.',
                    'points' => $user->points,
                    'user' => $user
                ], Response::HTTP_OK);
            }

            // Save quest completion to log
            $completedQuest = UserQuestLog::create([
                'user_id' => $user->id,
                'quest_name' => $quest->quest,
                'point' => $quest->point,
            ]);

            // Increment the user's total points in users table
            $user->increment('points', $quest->point);

            return response()->json([
                'message' => 'Quest completed!',
                'quest' => $completedQuest,
                'plus_point' => $quest->point,
                'user' => $user->fresh(), // ensure we return the updated user
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json([
                "message" => "Failed",
                "error" => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
