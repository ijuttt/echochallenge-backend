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

    public function completedQuest(Request $request,Quest $quest){
        try{
            $user = auth('sacntum')->user();
    
            // Simpan ke tabel user_quest_logs
            $completedQuest = UserQuestLog::create([
                'user_id' => $user->id,
                'quest_name' => $quest->quest,
                'point' => $quest->point,
            ]);
        
            return response()->json([
                'message' => 'Quest completed!',
                'quest' => $completedQuest,
                'plus_point' => $quest->poin
            ]);
        }catch(\Exception $e){
            return response()->json([
                "message" => "Failed",
                "error" => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
       
    }
}
