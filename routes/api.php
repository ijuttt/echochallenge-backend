<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DailyQuestController;
use App\Http\Controllers\QuestController;

Route::get('/quests', [QuestController::class, 'index']);
Route::apiResource('daily-quests', DailyQuestController::class);
