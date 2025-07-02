<?php

namespace App\Http\Controllers;

use App\Models\DailyQuest;
use Illuminate\Http\Request;

class DailyQuestController extends Controller
{
    public function index()
    {
        return DailyQuest::all();
    }
}
