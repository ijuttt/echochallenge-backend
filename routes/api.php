<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DailyQuestController;
use App\Http\Controllers\QuestController;

Route::post("login", [AuthController::class, "auth"]);

Route::middleware("auth:sacntum")->group(function (){
    Route::post("logout", [AuthController::class, "logout"]);
    Route::post("register", [AuthController::class, "create"]);
    Route::post("update", [AuthController::class, "update"]);
    Route::apiResource('quests', [QuestController::class]);
});
