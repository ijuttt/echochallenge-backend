<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DailyQuestController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\QuestController;

Route::post("login", [AuthController::class, "auth"]);

Route::middleware("auth:sanctum")->group(function (){
    Route::get('/posts', [PostController::class, 'index']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::put('/posts/{post}/like', [PostController::class, 'like']);
    Route::put('/posts/{post}/dislike', [PostController::class, 'dislike']);
    Route::delete('/posts/{post}', [PostController::class, 'destroy']);
    Route::post("/logout", [AuthController::class, "logout"]);
    Route::post("/register", [AuthController::class, "create"]);
    Route::post("/update", [AuthController::class, "update"]);
    Route::apiResource('quests',QuestController::class);
});
