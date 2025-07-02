<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DailyQuestController;

Route::apiResource('daily-quests', DailyQuestController::class);
